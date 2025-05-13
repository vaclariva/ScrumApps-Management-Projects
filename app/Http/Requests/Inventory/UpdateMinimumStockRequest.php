<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMinimumStockRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

     /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        // $minimumStock = array_map(function ($value) {
        //     // Step 1: Replace the thousand separator (period) with an empty string
        //     // Step 2: Replace the decimal separator (comma) with a period
        //     return str_replace(',', '.', str_replace('.', '', $value));
        // }, $this->input('minimum_stock', []));

        // $this->merge([
        //     'minimum_stock' => $minimumStock,
        // ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'minimum_stock' => ['nullable'],
        ];
    }

     /**
     * Get the validation attributes that apply to the request.
     */
    public function attributes(): array
    {
        return [
            'minimum_stock' => 'stok minimal',
        ];
    }
}
