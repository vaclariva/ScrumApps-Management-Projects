<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'feature_image' => ['nullable', 'image', 'max:2048'],
            'name' => ['required'],
            'categories' => ['nullable'],
            'categories.*' => ['exists:categories,id'],
            'type' => ['required'],
            'has_variant' => ['required'],
            'unit_id' => ['required_if:has_variant,0'],
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     */
    public function attributes(): array
    {
        return [
            'feature_image' => 'foto utama produk',
            'name' => 'nama',
            'type' => 'jenis',
            'has_variant' => 'produk memiliki varian?',
            'categories' => 'kategori',
            'unit_id' => 'satuan',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     */
    public function messages(): array
    {
        return [
            'feature_image.max' => 'Foto utama produk maksimal berukuran 2 mb.',
            'unit_id.required_if' => 'Kolom :attribute wajib diisi apabila tidak memiliki varian.',
        ];
    }
}
