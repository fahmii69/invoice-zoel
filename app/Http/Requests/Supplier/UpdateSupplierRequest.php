<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplierRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name'    => 'required', 'string',
            'address' => 'required',
            'phone'   => 'required',
            'pic'   => 'required',
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
            'name.required'    => 'Supplier Name must be filled in.',
            'address.required' => 'Supplier Address must be filled in.',
            'phone.required'   => 'Supplier Phone Number must be filled in.',
            'pic.required'     => 'Supplier Person in Charge must be filled in.',

        ];
    }
}
