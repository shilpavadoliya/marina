<?php

namespace App\Models;

use App\Traits\HasJsonResourcefulData;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class AvailableLocation
 *
 * @property int $id
 * @property string $name
 * @property string $short_name
 * @property string $base_unit
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|AvailableLocation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AvailableLocation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AvailableLocation query()
 * @method static \Illuminate\Database\Eloquent\Builder|AvailableLocation whereBaseUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AvailableLocation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AvailableLocation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AvailableLocation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AvailableLocation whereShortName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AvailableLocation whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class AvailableLocation extends BaseModel
{
    use HasFactory, HasJsonResourcefulData;

    protected $table = 'available_locations';

    const JSON_API_TYPE = 'available_locations';

    protected $fillable = [
        'name'
    ];

    public static $rules = [
        'name' => 'required|unique:available_locations',
          ];

    public function prepareLinks(): array
    {
        return [
            // 'self' => route('available_locations.show', $this->id),
        ];
    }

    public function prepareAttributes(): array
    {
        $fields = [
            'name' => $this->name,
            'created_at' => $this->created_at,
        ];

        return $fields;
    }

   
}
