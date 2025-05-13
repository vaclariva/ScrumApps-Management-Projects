<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            //'blocked' => ['required', 'boolean'],
            'photo_path_remove' => ['nullable'],
            'phone_number' => ['required','digits_between:9,13'],
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
            'blocked' => 'status',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     */
    public function messages(): array
    {
        return [
            'gender.required' => 'Kolom :attribute wajib dipilih.',
            'photo_path.required_if' => 'Kolom :attribute wajib untuk diisi.',
            'photo_path.max' => 'Foto maksimal berukuran 2 mb.',
        ];
    }
}
