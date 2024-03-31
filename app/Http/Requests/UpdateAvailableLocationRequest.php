<?php

namespace App\Http\Requests;

use App\Models\AvailableLocation;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateAvailableLocationRequest
 */
class UpdateAvailableLocationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules = AvailableLocation::$rules;
        $rules['name'] = 'required|unique:available_locations,name,'.$this->route('available-location');

        return $rules;
    }
}
