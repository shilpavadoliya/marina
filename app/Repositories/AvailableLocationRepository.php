<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\PurchaseItem;
use App\Models\SaleItem;
use App\Models\AvailableLocation;

/**
 * Class RoleRepository
 */
class AvailableLocationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'created_at',
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
    public function model()
    {
        return AvailableLocation::class;
    }
}
