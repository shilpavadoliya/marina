<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Models\Supplier;
use App\Models\Order;
use App\Models\Setting;
use App\Repositories\OrderRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use App\Models\User;
/**
 * Class PurchaseAPIController
 */
class OrderAPIController extends AppBaseController
{
    /** @var orderRepository */
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index(Request $request): OrderCollection
    {
        try{
        $perPage = getPageSize($request);
        $search = $request->filter['search'] ?? '';
        // $supplier = (Supplier::where('name', 'LIKE', "%$search%")->get()->count() != 0);
        // $warehouse = (Warehouse::where('name', 'LIKE', "%$search%")->get()->count() != 0);
        $purchases = $this->orderRepository;
        // if ($supplier || $warehouse) {
        //     $purchases->whereHas('supplier', function (Builder $q) use ($search, $supplier) {
        //         if ($supplier) {
        //             $q->where('name', 'LIKE', "%$search%");
        //         }
        //     })->whereHas('warehouse', function (Builder $q) use ($search, $warehouse) {
        //         if ($warehouse) {
        //             $q->where('name', 'LIKE', "%$search%");
        //         }
        //     });
        // }

        // if ($request->get('start_date') && $request->get('end_date')) {
        //     $purchases->whereBetween('date', [$request->get('start_date'), $request->get('end_date')]);
        // }

        // if ($request->get('warehouse_id')) {
        //     $purchases->where('warehouse_id', $request->get('warehouse_id'));
        // }

        // if ($request->get('status')) {
        //     $purchases->where('status', $request->get('status'));
        // }


        // if ($request->get('isb2c')) {
            
            $user = User::where('id', auth()->id())->first();
            $roleId = $user->roles()->first()->id;
            
            
           $supplier = Supplier::where('email', $user->email)->first();
           
            //$purchases->where('is_customer', 1);
            if(!empty($roleId) && ($roleId==6)) {
                $purchases = $purchases->where('supplier_id', $supplier->id);
            }
        // }

        $purchases = $purchases->paginate($perPage);

        OrderResource::usingWithCollection();

        return new OrderCollection($purchases);
        }catch(\Exception $e){
            dd($e);
        }
    }

    public function purchaseInfo(Order $order): JsonResponse
    {
        $purchase = $order->load(['orderItems', 'warehouse', 'supplier']);
        // dd($purchase);
        $keyName = [
            'email', 'company_name', 'phone', 'address',
        ];
        $purchase['company_info'] = Setting::whereIn('key', $keyName)->pluck('value', 'key')->toArray();

        return $this->sendResponse($purchase, 'Order information retrieved successfully');
    }

    public function show($id): OrderResource
    {
        $purchase = $this->orderRepository->find($id);

        return new OrderResource($purchase);
    }

    public function updateStatus($id, Request $request): OrderResource
    {
        // dd('come');
        $purchase = $this->orderRepository->find($id);
        $purchase->update(['status' => $request->get('value')]);

        return new OrderResource($purchase);
    }
}
