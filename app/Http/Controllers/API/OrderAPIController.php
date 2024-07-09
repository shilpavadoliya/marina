<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Resources\PurchaseCollection;
use App\Http\Resources\PurchaseResource;
use App\Models\Supplier;
use App\Models\Order;
use App\Models\Purchase;
use App\Models\Warehouse;
use App\Models\Setting;
use App\Repositories\PurchaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use App\Models\User;
use App\Models\Userbillingdetails;
/**
 * Class PurchaseAPIController
 */
class OrderAPIController extends AppBaseController
{
    /** @var purchaseRepository */
    private $purchaseRepository;

    public function __construct(PurchaseRepository $purchaseRepository)
    {
        $this->purchaseRepository = $purchaseRepository;
    }

    public function index(Request $request): PurchaseCollection
    {
        $perPage = getPageSize($request);
        $search = $request->filter['search'] ?? '';
        $supplier = (Supplier::where('name', 'LIKE', "%$search%")->get()->count() != 0);
        $warehouse = (Warehouse::where('name', 'LIKE', "%$search%")->get()->count() != 0);
        $purchases = $this->purchaseRepository;
        if ($supplier || $warehouse) {
            $purchases->whereHas('supplier', function (Builder $q) use ($search, $supplier) {
                if ($supplier) {
                    $q->where('name', 'LIKE', "%$search%");
                }
            })->whereHas('warehouse', function (Builder $q) use ($search, $warehouse) {
                if ($warehouse) {
                    $q->where('name', 'LIKE', "%$search%");
                }
            });
        }

        if ($request->get('start_date') && $request->get('end_date')) {
            $purchases->whereBetween('date', [$request->get('start_date'), $request->get('end_date')]);
        }

        if ($request->get('warehouse_id')) {
            $purchases->where('warehouse_id', $request->get('warehouse_id'));
        }

        if ($request->get('status')) {
            $purchases->where('status', $request->get('status'));
        }


        $user = User::where('id', auth()->id())->first();
        $roleId = $user->roles()->first()->id;

        $purchases->where('is_customer',2);
        
        if($roleId == 6) {
            $supplier = Supplier::where('email',$user->email)->first();
            $purchases->where('warehouse_id', $supplier->warehouse_id);
            $purchases->where('supplier_id', $supplier->id);
        }
        
        
        if($request->get('is_customer') && $request->get('is_customer') == 1){
            $purchases->where('is_customer', 1);
        }

        $purchases = $purchases->paginate($perPage);

        PurchaseResource::usingWithCollection();

        return new PurchaseCollection($purchases);
    }

    public function purchaseInfo(Purchase $purchase): JsonResponse
    {
        $purchase = $purchase->load(['purchaseItems.product', 'warehouse', 'supplier']);
        
        $keyName = [
            'email', 'company_name', 'phone', 'address',
        ];

        $purchase['formatted_created_at'] = \Carbon\Carbon::parse($purchase->created_at)->format('Y-m-d');
        $purchase['company_info'] = Setting::whereIn('key', $keyName)->pluck('value', 'key')->toArray();
    
        $purchase['customer'] = Userbillingdetails::where('user_id', $purchase->user_id)->first();

        return $this->sendResponse($purchase, 'Order information retrieved successfully');
    }

    public function show($id): PurchaseResource
    {
        $purchase = $this->purchaseRepository->find($id);

        return new PurchaseResource($purchase);
    }

    public function updateStatus($id, Request $request): PurchaseResource
    {
        // dd('come');
        $purchase = $this->purchaseRepository->find($id);
        $purchase->update(['status' => $request->get('value')]);

        return new PurchaseResource($purchase);
    }

        /**
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function pdfDownload(Purchase $purchase): JsonResponse
    {
        $purchase = $purchase->load('purchaseItems.product', 'supplier');
        $purchase['customer'] = Userbillingdetails::where('user_id', $purchase->user_id)->first();


        $data = [];
        if (Storage::exists('pdf.purchase-pdf-'.$purchase->reference_code.'.pdf')) {
            Storage::delete('pdf.purchase-pdf-'.$purchase->reference_code.'.pdf');
        }

        $companyLogo = getLogoUrl();

        $companyLogo = (string) \Image::make($companyLogo)->encode('data-url');

        $pdf = PDF::loadView('pdf.b2c-purchase-pdf', compact('purchase','companyLogo'))->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        Storage::disk(config('app.media_disc'))->put('pdf/Purchase-'.$purchase->reference_code.'.pdf', $pdf->output());
        $data['purchase_pdf_url'] = Storage::url('pdf/Purchase-'.$purchase->reference_code.'.pdf');

        return $this->sendResponse($data, 'pdf retrieved Successfully');
    }
}
