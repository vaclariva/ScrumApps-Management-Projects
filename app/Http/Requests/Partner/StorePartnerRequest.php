<?php

namespace App\Http\Requests\Partner;

use Illuminate\Foundation\Http\FormRequest;

class StorePartnerRequest extends FormRequest
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
            'name' => ['required'],
            'group' => ['required'],
            'credit_limit' => ['nullable'],
            'province_id' => ['nullable'],
            'regency_id' => ['nullable'],
            'district_id' => ['nullable'],
            'address' => ['nullable'],
            'phone_number' => ['nullable','digits_between:9,13'],
            'email' => ['required', 'email', 'unique:partners,email'],
            'is_access_product_dev' => ['required']
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     */
    public function attributes(): array
    {
        return [
            'name' => 'nama',
            'group' => 'kelompok',
            'credit_limit' => 'plafon',
            'province_id' => 'provinsi',
            'regency_id' => 'kab/kota',
            'district_id' => 'kecamatan',
            'address' => 'alamat',
            'phone_number' => 'kontak',
            'email' => 'alamat email',
            'is_access_product_dev' => 'akses produk pengembangan'
        ];
    }
}
