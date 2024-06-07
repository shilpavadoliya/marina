<?php

namespace App\Repositories;

use App\Models\ProductSubCategory;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class ProductSubCategoryRepository
 */
class ProductSubCategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'category_id',
        'created_at',
    ];

    /**
     * @var string[]
     */
    protected $allowedFields = [

    ];

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
        return productSubCategory::class;
    }

    /**
     * @return LengthAwarePaginator|Collection|mixed
     */
    public function storeProductSubCategory($input)
    {
        try {
            DB::beginTransaction();
            $productSubCategory = $this->create($input);
            if (isset($input['image']) && $input['image']) {
                $media = $productSubCategory->addMedia($input['image'])->toMediaCollection(productSubCategory::PATH,
                    config('app.media_disc'));
            }
            DB::commit();

            return $productSubCategory;
        } catch (Exception $e) {
            // dd($e);
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @return LengthAwarePaginator|Collection|mixed
     */
    public function updateProductSubCategory($input, $id)
    {
        try {
            DB::beginTransaction();
            $productSubCategory = $this->withCount('products');
            $productSubCategory = $productSubCategory->update($input, $id);
            if (isset($input['image']) && $input['image']) {
                $productSubCategory->clearMediaCollection(productSubCategory::PATH);
                $productSubCategory['image_url'] = $productSubCategory->addMedia($input['image'])->toMediaCollection(productSubCategory::PATH,
                    config('app.media_disc'));
            }
            DB::commit();

            return $productSubCategory;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
