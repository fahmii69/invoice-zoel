<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
            'name'           => 'required', 'string',
            'address'        => 'required',
            'work_phone'     => 'required',
            'state'          => 'nullable',
            'province'       => 'nullable',
            'postcode'       => 'nullable',
            'country'        => 'nullable',
            'payment_terms'  => 'nullable',
            'customer_type'  => 'nullable',
            'send_reminders' => 'nullable'
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
            'name.required'       => 'Customer Name must be filled in.',
            'address.required'    => 'Customer Address must be filled in.',
            'work_phone.required' => 'Customer Phone Number must be filled in.',
        ];
    }
}
