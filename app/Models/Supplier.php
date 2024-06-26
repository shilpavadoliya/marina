<?php

namespace App\Models;

use App\Traits\HasJsonResourcefulData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Models\Supplier
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier query()
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $country
 * @property string $city
 * @property string $address
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supplier whereUpdatedAt($value)
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Purchase> $purchases
 * @property-read int|null $purchases_count
 *
 * @mixin \Eloquent
 */
class Supplier extends BaseModel  implements HasMedia

{
    use HasFactory, InteractsWithMedia, HasJsonResourcefulData;

    protected $table = 'suppliers';

    const JSON_API_TYPE = 'suppliers';

    public const SUPPLIER_DOC = 'supplier_docs';


    protected $fillable = [
        'name',
        'email',
        'phone',
        'country',
        'city',
        'address',
        'business_constitution',
        'distributor_category',
        'managing_partner',
        'contact_person',
        'phone_number',
        'mobile_number',
        'principal_address',
        'brands_handled',
        'cst_number',
        'vat_number',
        'gstin',
        'service_tax_number',
        'pan',
        'bank_name',
        'bank_branch',
        'account_number',
        'ifsc_code',
        'appointment_type',
        'distributor_margin',
        'payment_terms',
        'security_required',
        'territory_assigned',
        'customers_covered',
        'claim_periodicity',
        'state',
        'status',
        'user_id',
        'area_pin_code',
        'warehouse_id'

    ];

    public static $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:suppliers',
        'phone' => 'required|numeric',
        'country' => 'required',
        'city' => 'required',
        'address' => 'required',
    ];

    public function prepareLinks(): array
    {
        return [
            'self' => route('suppliers.show', $this->id),
        ];
    }

    public function getDocument($docName): string
    {
        /** @var Media $media */
        $media = $this->getMedia(Supplier::SUPPLIER_DOC)->where('name', $docName)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return '';
    }

    public function warehouse()
{
    return $this->belongsTo(Warehouse::class, 'warehouse_id', 'id');
}

    public function cityName()
    {
        return $this->belongsTo(City::class, 'city', 'id');
    }

    public function countryName()
    {
        return $this->belongsTo(Country::class, 'country', 'id');
    }

    public function stateName()
{
        return $this->belongsTo(State::class, 'state', 'id');
    }

    public function prepareAttributes(): array
    {
        $imageUrls = $this->image_url;

        $fields = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'created_at' => $this->created_at,
            'status' => $this->status,
            'business_constitution' => $this->business_constitution,
            'distributor_category' => $this->distributor_category,
            'managing_partner'  => $this->managing_partner,
            'contact_person'  => $this->contact_person,
            'phone_number'  => $this->phone_number,
            'mobile_number'  => $this->mobile_number,
            'principal_address'  => $this->principal_address,
            'brands_handled'  => $this->brands_handled,
            'cst_number'  => $this->cst_number,
            'vat_number'  => $this->vat_number,
            'gstin'  => $this->gstin,
            'service_tax_number'  => $this->service_tax_number,
            'pan'  => $this->pan,
            'bank_name'  => $this->bank_name,
            'bank_branch'  => $this->bank_branch,
            'account_number'  => $this->account_number,
            'ifsc_code'  => $this->ifsc_code,
            'appointment_type'  => $this->appointment_type,
            'distributor_margin'  => $this->distributor_margin,
            'payment_terms'  => $this->payment_terms,
            'security_required'  => $this->security_required,
            'territory_assigned'  => $this->territory_assigned,
            'customers_covered'  => $this->customers_covered,
            'claim_periodicity'  => $this->claim_periodicity,
            
            'status'  => $this->status,
            'user_id'  => $this->user_id,
            'area_pin_code' => explode(',', $this->area_pin_code),
            'pan_card' => $this->getDocument('panCard'),
            'aadhar_card' => $this->getDocument('aadharCard'),
            'fssai_license' => $this->getDocument('fssaiLicense'),
            'gst_certificate' => $this->getDocument('gstCertificate'),
            'warehouse_id' => $this->warehouse_id,
            'warehouse_name' => $this->warehouse ? $this->warehouse->name : null,
            'country_id' => $this->country,
            'country_name' => $this->countryName->name,
            'state_id' => $this->state,
            'state_name' => $this->stateName->name,
            'city_id' => $this->city,
            'city_name' => $this->cityName->name,
            'images' => $imageUrls['imageUrls'] ?? [],
        ];

        return $fields;
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class, 'supplier_id', 'id');
    }    

    /**
     * @return array|string
     */
    public function getImageUrlAttribute()
    {
        /** @var Media $media */
        $medias = $this->getMedia(Supplier::SUPPLIER_DOC);
        $images = [];
        if (! empty($medias)) {
            foreach ($medias as $key => $media) {
                $images['imageUrls'][$key] = $media->getFullUrl();
                $images['id'][$key] = $media->id;
            }

            return $images;
        }

        return '';
    }
}
