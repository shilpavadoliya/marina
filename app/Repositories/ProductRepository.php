<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use App\Models\Price;

/**
 * Class ProductCategoryRepository
 */
class ProductRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'code',
        'product_cost',
        'product_price',
        'product_unit',
        'sale_unit',
        'purchase_unit',
        'stock_alert',
        'order_tax',
        'notes',
        'created_at',
    ];

    /**
     * @var string[]
     */
    protected $allowedFields = [
        'name',
        'code',
        'product_cost',
        'product_price',
        'product_unit',
        'sale_unit',
        'purchase_unit',
        'stock_alert',
        'order_tax',
        'notes',
    ];

    public function getAvailableRelations(): array
    {
        return array_values(Product::$availableRelations);
    }

    /**
     * Return searchable fields
     */
    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model(): string
    {
        return Product::class;
    }

    /**
     * @return LengthAwarePaginator|Collection|mixed
     */
    public function storeProduct($input)
    {
        try {
            DB::beginTransaction();
            $product = $this->create($input);
            if (isset($input['images']) && ! empty($input['images'])) {
                foreach ($input['images'] as $image) {
                    $product['image_url'] = $product->addMedia($image)->toMediaCollection(Product::PATH,
                        config('app.media_disc'));
                }
            }

            if (isset($input['image']) && ! empty($input['image'])) {
                $product['main_image_url'] = $product->addMedia($input['image'])->toMediaCollection(Product::PRODUCT_MAIN_IMAGE_PATH,
                config('app.media_disc'));
            }

            if (!empty($input['prices']) && is_array($input['prices'])) {
                $pricesData = [];
    
                foreach ($input['prices'] as $price) {
                    $pricesData[] = new Price([
                        'location_id' => $price['location'],
                        'product_id' => $product->id,
                        'price' => $price['price'],
                    ]);
                }
    
                $product->prices()->saveMany($pricesData);
            }
            

            

            DB::commit();

            return $product;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @return LengthAwarePaginator|Collection|mixed
     */
    public function updateProduct($input, $id)
    {
        try {
            DB::beginTransaction();
            $product = $this->update($input, $id);
            if (isset($input['images']) && ! empty($input['images'])) {
                foreach ($input['images'] as $image) {
                    $product['image_url'] = $product->addMedia($image)->toMediaCollection(Product::PATH,
                        config('app.media_disc'));
                }
            }
        
            if (isset($input['image']) && ! empty($input['image'])) {
                $product->clearMediaCollection(Product::PRODUCT_MAIN_IMAGE_PATH);
                $product['main_image_url'] = $product->addMedia($input['image'])->toMediaCollection(Product::PRODUCT_MAIN_IMAGE_PATH,
                    config('app.media_disc'));

               
            }

            if (!empty($input['prices']) && is_array($input['prices'])) {

                $updatedPricesData = [];

                $locationIds = [];
                foreach ($input['prices'] as $price) {
                    $locationIds[] = $price['location'];
                }


                // Fetch existing prices based on location_id and product_id
                $existingPrices = Price::whereIn('location_id', $locationIds)
                                        ->where('product_id', $product->id)
                                        ->get()
                                        ->keyBy('location_id');

                
                foreach ($input['prices'] as $price) {
                    $locationId = $price['location'];
                    $productId = $product->id;

                    if (isset($existingPrices[$locationId])) {
                        // Update existing price
                        $existingPrices[$locationId]->update(['price' => $price['price']]);
                    } else {
                        // Create new price
                        $updatedPricesData[] = new Price([
                            'location_id' => $locationId,
                            'product_id' => $productId,
                            'price' => $price['price'],
                        ]);
                    }
                }

                // Save new prices
                if (!empty($updatedPricesData)) {
                    $product->prices()->saveMany($updatedPricesData);
                }
            }
            
            DB::commit();

            return $product;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function generateBarcode($input, $reference_code): bool
    {
        $barcodeType = null;
        $generator = new BarcodeGeneratorPNG();
        switch ($input['barcode_symbol']) {
            case Product::CODE128:
                $barcodeType = $generator::TYPE_CODE_128;
                break;
            case Product::CODE39:
                $barcodeType = $generator::TYPE_CODE_39;
                break;
            case Product::EAN8:
                $barcodeType = $generator::TYPE_EAN_8;
                break;
            case Product::EAN13:
                $barcodeType = $generator::TYPE_EAN_13;
                break;
            case Product::UPC:
                $barcodeType = $generator::TYPE_UPC_A;
                break;
        }

        Storage::disk(config('app.media_disc'))->put('product_barcode/barcode-'.$reference_code.'.png',
            $generator->getBarcode($input['code'], $barcodeType, 4, 70));

        return true;
    }
}
