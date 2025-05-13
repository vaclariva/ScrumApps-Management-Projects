<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Foundation\Http\FormRequest;

class StoreInventoryRequest extends FormRequest
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
        $quantities = array_map(function ($value) {
            // Step 1: Replace the thousand separator (period) with an empty string
            // Step 2: Replace the decimal separator (comma) with a period
            return str_replace(',', '.', str_replace('.', '', $value));
        }, $this->input('quantity', []));

        $this->merge([
            'quantity' => $quantities,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'warehouse_id' => ['required', 'exists:warehouses,id'],
            'type' => ['required', 'in:Stock In,Stock Out'],
            'product_variant_id' => ['required', 'array'],
            'product_variant_id.*' => ['required', 'distinct', 'exists:product_variants,id'],
            'quantity' => ['required', 'array'],
            'quantity.*' => ['required', 'numeric', 'min:0.01', 'regex:/^\d+(\.\d{1,2})?$/'],
            'checklist_correction' => ['nullable', 'array'],
            'checklist_correction.*' => ['nullable', 'in:0,1'],
            'correction' => ['nullable', 'array'],
            'correction.*' => ['required_if:checklist_correction.*,1']
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     */
    public function attributes(): array
    {
        return [
            'warehouse_id' => 'lokasi',
            'product_variant_id' => 'produk',
            'product_variant_id.*' => 'produk',
            'quantity' => 'jumlah',
            'quantity.*' => 'jumlah',
            'checklist_correction' => 'centang koreksi',
            'correction' => 'koreksi',
            'correction.*' => 'koreksi'
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     */
    public function messages(): array
    {
        return [
            'correction.*.required_if' => 'Kolom :attribute wajib diisi.',
        ];
    }

}
