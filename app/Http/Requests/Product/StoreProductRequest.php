<?php

namespace App\Http\Requests\Product;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**`
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name'        => 'required',
            'category_id' => 'required',
            'sale_price'  => 'required',
            'unit'  => 'required',
            'image'       => 'nullable', 'mimes:jpg,png,jpig,gif',
            // 'buy_price'         => 'required',
            // 'current_inventory' => 'required',

        ];
    }

    /**
     * Validation custom message.
     *
     * @return array<string>
     */
    public function messages(): array
    {
        return [
            'name.required'        => ' Product Name must be filled in.',
            'category_id.required' => ' Category must be filled in.',
            'unit.required'        => ' Unit must be filled in.',
            'sale_price.required'  => ' Sale Price must be filled in.',
            // 'buy_price.required'         => ' Buy Price must be filled in.',
            // 'current_inventory.required' => ' Stock must be filled in.',
        ];
    }
}
