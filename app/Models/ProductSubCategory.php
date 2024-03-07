<?php

namespace App\Models;

use App\Models\Contracts\JsonResourceful;
use App\Traits\HasJsonResourcefulData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Class ProductCategory
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $image_url
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|Media[] $media
 * @property-read int|null $media_count
 *
 * @method static Builder|ProductCategory newModelQuery()
 * @method static Builder|ProductCategory newQuery()
 * @method static Builder|ProductCategory query()
 * @method static Builder|ProductCategory whereCreatedAt($value)
 * @method static Builder|ProductCategory whereId($value)
 * @method static Builder|ProductCategory whereName($value)
 * @method static Builder|ProductCategory whereUpdatedAt($value)
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 *
 * @mixin \Eloquent
 */
class ProductSubCategory extends BaseModel implements HasMedia, JsonResourceful
{
    use HasFactory, InteractsWithMedia, HasJsonResourcefulData;

    protected $table = 'product_sub_categories';

    const JSON_API_TYPE = 'product-product_sub_categories';

    public const PATH = 'product_sub_category';

    protected $appends = ['image_url'];

    protected $fillable = [
        'name',
        'category_id'
    ];

    public static $rules = [
        'name' => 'required|unique:product_sub_categories',
        'image' => 'image|mimes:jpg,jpeg,png',
        'category_id' =>'required|exists:product_categories'
    ];

    public function getImageUrlAttribute(): string
    {
        /** @var Media $media */
        $media = $this->getMedia(ProductSubCategory::PATH)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return '';
    }

    public function prepareLinks(): array
    {
        return [
            'self' => route('product-sub-categories.show', $this->id),
        ];
    }

    public function prepareAttributes(): array
    {
        $fields = [
            'name' => $this->name,
            'image' => $this->image_url,
            'products_count' => $this->products()->count(),
            'category_id' => $this->category_id
        ];

        return $fields;
    }

    public function prepareProductCategory(): array
    {
        $fields = [
            'id' => $this->id,
            'name' => $this->name,
            'category_id' => $this->category_id
        ];

        return $fields;
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'product_category_id', 'id');
    }

    public function category() {
        return $this->belongsTo('App\Models\ProductCategory');
    }

    public static function getSubCategory(){
        return self::with('category')->get();
    }
}
