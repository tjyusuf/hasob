<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAssetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required',
            'serial' => 'required|integer',
            'purchase' => 'required|date',
            'start_use' => 'required|date',
            'warranty_expiry' => 'required|date',
            'degradation_in_years' => 'required|integer',
            'purchase_price' => 'required',
            'current_value' => 'required',
            'location' => 'required'
        ];
    }
}
