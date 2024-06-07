<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Http\Resources\SupplierCollection;
use App\Http\Resources\SupplierResource;
use App\Imports\SupplierImport;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Repositories\SupplierRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


/**
 * Class SupplierAPIController
 */
class SupplierAPIController extends AppBaseController
{
    /** @var SupplierRepository */
    private $supplierRepository;

    public function __construct(SupplierRepository $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    public function index(Request $request): SupplierCollection
    {
        $perPage = getPageSize($request);

        $user = User::where('id', auth()->id())->first();
        $roleId = $user->roles()->first()->id;
        
        $suppliers = $this->supplierRepository;

        if(!empty($roleId) && $roleId == 2) {
            $suppliers->where('user_id', auth()->id());
        }

        $suppliers = $suppliers->paginate($perPage);
        SupplierResource::usingWithCollection();

        return new SupplierCollection($suppliers);
    }

    /**
     * @throws ValidatorException
     */
    public function store(CreateSupplierRequest $request): SupplierResource
    {
        $input = $request->all();
        $input['user_id'] = auth()->id();
        $supplier = $this->supplierRepository->create($input);

        return new SupplierResource($supplier);
    }

    public function show($id): SupplierResource
    {
        $supplier = $this->supplierRepository->find($id);

        return new SupplierResource($supplier);
    }

    /**
     * @throws ValidatorException
     */
    public function update(UpdateSupplierRequest $request, $id): SupplierResource
    {
        $input = $request->all();
        $supplier = $this->supplierRepository->update($input, $id);

        return new SupplierResource($supplier);
    }

    public function destroy($id): JsonResponse
    {
        $purchaseModel = [
            Purchase::class,
        ];
        $useSupplier = canDelete($purchaseModel, 'supplier_id', $id);
        if ($useSupplier) {
            $this->sendError('Supplier can\'t be deleted.');
        }
        $this->supplierRepository->delete($id);

        return $this->sendSuccess('Supplier deleted successfully');
    }

    public function importSuppliers(Request $request): JsonResponse
    {
        Excel::import(new SupplierImport(), request()->file('file'));

        return $this->sendSuccess('Suppliers imported successfully');
    }

    
    public function changeActiveStatus($id): SupplierResource
    {
        $supplier = $this->supplierRepository->find($id);
        $status = $supplier->status == 0 ? 1 : 0;
        $supplier->update(['status' => $status]);

        return new SupplierResource($supplier);
    }

}
