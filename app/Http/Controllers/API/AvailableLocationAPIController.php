<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateAvailableLocationRequest;
use App\Http\Requests\UpdateAvailableLocationRequest;
use App\Http\Resources\AvailableLocationCollection;
use App\Http\Resources\AvailableLocationResource;
use App\Models\AvailableLocation;
use App\Repositories\AvailableLocationRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class AvailableLocationAPIController
 */
class AvailableLocationAPIController extends AppBaseController
{
    /**
     * @var AvailableLocationRepository
     */
    private $availableLocationRepository;

    public function __construct(AvailableLocationRepository $availableLocationRepository)
    {
        $this->availableLocationRepository = $availableLocationRepository;
    }

    public function index(Request $request): AvailableLocationCollection
    {
        $perPage = getPageSize($request);
        $units = $this->availableLocationRepository;


        $units = $units->paginate($perPage);

        AvailableLocationResource::usingWithCollection();

        return new AvailableLocationCollection($units);
    }

    /**
     * @throws ValidatorException
     */
    public function store(CreateAvailableLocationRequest $request): AvailableLocationResource
    {
        $input = $request->all();
        $unit = $this->availableLocationRepository->create($input);

        return new AvailableLocationResource($unit);
    }

    public function show($id): AvailableLocationResource
    {
        $unit = $this->availableLocationRepository->find($id);

        return new AvailableLocationResource($unit);
    }

    /**
     * @throws ValidatorException
     */
    public function update(UpdateAvailableLocationRequest $request, $id): AvailableLocationResource
    {
        $input = $request->all();
        $unit = $this->availableLocationRepository->update($input, $id);

        return new AvailableLocationResource($unit);
    }

    public function destroy($id): JsonResponse
    {
        $productModels = [
            AvailableLocation::class,
        ];
        $result = canDelete($productModels, 'id', $id);
        if ($result) {
            $this->availableLocationRepository->delete($id);
            return $this->sendSuccess('Available Location deleted successfully');
        }
        return $this->sendError('Available Location can\'t be deleted.');
    }
}
