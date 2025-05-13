<?php

namespace App\Http\Requests\Partner;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class StorePasswordRequest extends FormRequest
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
            'token' => ['required'],
            'email' => ['required', 'email', 'exists:partners,email'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'is_weak_password' => ['required', 'boolean'],
            'checklist_weak_password' => ['nullable', 'boolean']
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     */
    public function attributes(): array
    {
        return [
            'password' => 'kata sandi',
        ];
    }
}
