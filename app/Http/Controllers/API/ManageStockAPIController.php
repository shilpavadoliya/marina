<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ManageStockCollection;
use App\Http\Resources\ManageStockResource;
use App\Repositories\ManageStockRepository;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Supplier;
/**
 * Class UserAPIController
 */
class ManageStockAPIController extends AppBaseController
{
    private $manageStockRepository;

    public function __construct(ManageStockRepository $manageStockRepository)
    {
        $this->manageStockRepository = $manageStockRepository;
    }

    public function stockReport(Request $request): ManageStockCollection
    {
        $request->request->remove('filter');
        $perPage = getPageSize($request);
        $search = $request->get('search');
        $warehouseId = $request->get('warehouse_id');

        
        $user = User::where('id', auth()->id())->first();
        $roleId = $user->roles()->first()->id;
        
        if($roleId == 6) {
            $supplier = Supplier::where('email',$user->email)->first();
            $warehouseId =  $supplier->warehouse_id;
        }

        if ($search && $search != 'null') {
            $stocks = $this->manageStockRepository->whereHas('product.productCategory',
                function ($query) use ($search) {
                    $query->where('products.code', 'like', '%'.$search.'%')
                        ->orWhere('products.name', 'like', '%'.$search.'%')
                        ->orWhere('products.product_cost', 'like', '%'.$search.'%')
                        ->orWhere('products.product_price', 'like', '%'.$search.'%')
                        ->orWhere('products.product_price', 'like', '%'.$search.'%')
                        ->orWhere('product_categories.name', 'like', '%'.$search.'%');
                        
                })->where('warehouse_id', $warehouseId)->orderBy('id', 'asc')->paginate($perPage);
        } else {
            $stocks = $this->manageStockRepository->where('warehouse_id', $warehouseId)->paginate($perPage);
        }
        ManageStockResource::usingWithCollection();

        return new ManageStockCollection($stocks);
    }
}
