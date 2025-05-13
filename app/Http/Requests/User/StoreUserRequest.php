<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->is_superadmin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'photo_path' => ['nullable', 'image', 'max:2048'],
            'name' => ['required'],
            'gender' => ['required', 'in:male,female'],
            'phone_number' => ['required','digits_between:9,13'],
            'email' => ['required', 'email', 'unique:users,email'],
            'role' => 'required|in:' . implode(',',listRoles()),
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     */
    public function attributes(): array
    {
        return [
            'photo_path' => 'foto',
            'name' => 'nama',
            'gender' => 'jenis kelamin',
            'phone_number' => 'no telepon',
            'email' => 'email',
            'role' => 'role',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     */
    public function messages(): array
    {
        return [
            'gender.required' => 'Kolom :attribute wajib dipilih.',
            'photo_path.max' => 'Foto maksimal berukuran 2 mb.',
        ];
    }
}
