<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateProductSubCategoryRequest;
use App\Http\Requests\UpdateProductSubCategoryRequest;
use App\Http\Resources\ProductSubCategoryCollection;
use App\Http\Resources\ProductSubCategoryResource;
use App\Models\ProductSubCategory;
use App\Repositories\ProductSubCategoryRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductSubCategoryAPIController extends AppBaseController
{
    protected $productSubCategoryRepository;

    public function __construct(ProductSubCategoryRepository $productSubCategoryRepository)
    {
        $this->productSubCategoryRepository = $productSubCategoryRepository;
    }

    public function index(Request $request): ProductSubCategoryCollection
    {
        $perPage = getPageSize($request);
        $sort = null;
        if ($request->sort == 'products_count') {
            $sort = 'asc';
            $request->request->remove('sort');
        } elseif ($request->sort == '-products_count') {
            $sort = 'desc';
            $request->request->remove('sort');
        }
        $productSubCategory = $this->productSubCategoryRepository->withCount('products')->when($sort,
            function ($q) use ($sort) {
                $q->orderBy('products_count', $sort);
            })->paginate($perPage);


        ProductSubCategoryResource::usingWithCollection();

        // dd(new ProductSubCategoryCollection($productSubCategory));
        return new ProductSubCategoryCollection($productSubCategory);
    }

    public function store(CreateProductSubCategoryRequest $request): ProductSubCategoryResource
    {
        $input = $request->all();
        // dd($input);
        $productCategory = $this->productSubCategoryRepository->storeProductSubCategory($input);

        return new ProductSubCategoryResource($productCategory);
    }

    public function show($id): ProductSubCategoryResource
    {
        $productCategory = $this->productSubCategoryRepository->find($id);

        return new ProductSubCategoryResource($productCategory);
    }

    public function update(UpdateProductSubCategoryRequest $request, $id): ProductSubCategoryResource
    {
        $input = $request->all();
        $productCategory = $this->productSubCategoryRepository->updateProductSubCategory($input, $id);

        return new ProductSubCategoryResource($productCategory);
    }

    public function destroy($id): JsonResponse
    {
        $productModels = [
            ProductSubCategory::class,
        ];
        $result = canDelete($productModels, 'product_category_id', $id);
        if ($result) {
            return $this->sendError(__('messages.error.product_category_can_not_delete'));
        }
        $this->productSubCategoryRepository->delete($id);

        return $this->sendSuccess(__('messages.success.product_category_delete'));
    }
}
