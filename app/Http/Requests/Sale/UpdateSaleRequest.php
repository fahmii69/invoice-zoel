<?php

namespace App\Http\Requests\Sale;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSaleRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'code'        => [Rule::unique('sales', 'code')->ignore($this->sale)],
            'customer_id' => 'required',
            'sales_date'  => 'required',
            'due_date'    => 'required',
            'sub_total'   => 'required',
            'notes'       => 'nullable',
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
            'sales_date.required'  => ' Sales Date must be filled in.',
            'due_date.required'  => ' Due Date must be filled in.',
            'customer_id.required' => ' Customer must be filled in.',
        ];
    }
}
