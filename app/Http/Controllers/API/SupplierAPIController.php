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
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Country;
use App\Models\State;

/**
 * Class SupplierAPIController
 */
class SupplierAPIController extends AppBaseController
{
    /** @var SupplierRepository */
    private $supplierRepository;
    private $userRepository;

    public function __construct(SupplierRepository $supplierRepository, UserRepository $userRepository)
    {
        $this->supplierRepository = $supplierRepository;
        $this->userRepository = $userRepository;
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
        if(!empty($input['areaPinTags'])){
            $input['area_pin_code'] = implode(', ', $input['areaPinTags']);
        }
        
        $supplier = $this->supplierRepository->create($input);

        $documents = ['panCard', 'aadharCard', 'fssaiLicense', 'gstCertificate'];

        foreach ($documents as $document) {
            if ($request->hasFile($document)) {
                $supplier->addMedia($request->file($document))
                        ->usingName($document)
                        ->toMediaCollection(Supplier::SUPPLIER_DOC, config('app.media_disc'));
            }
        }

        $userInput = [];
        $userInput['first_name'] = $input['name'];
        $userInput['last_name'] = $input['name'];
        $userInput['email'] = $input['email'];
        $userInput['phone'] = $input['phone'];
        $userInput['password'] = $input['password'];
        $userInput['status'] = 1;
        $userInput['language'] = 1;
        $userInput['role_id'] = 6;

        $user = $this->userRepository->storeUser($userInput);

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

        if(!empty($input['areaPinTags'])){
         
            $input['area_pin_code'] = implode(', ', $input['areaPinTags']);
        }

        
        $supplier = $this->supplierRepository->update($input, $id);

        $documents = ['panCard', 'aadharCard', 'fssaiLicense', 'gstCertificate'];

        foreach ($documents as $document) {
            if ($request->hasFile($document)) {
                $supplier->addMedia($request->file($document))
                        ->usingName($document)
                        ->toMediaCollection(Supplier::SUPPLIER_DOC, config('app.media_disc'));
            }
        }
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
