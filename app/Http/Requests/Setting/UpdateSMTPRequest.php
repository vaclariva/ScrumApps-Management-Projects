<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSMTPRequest extends FormRequest
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
            'from_name' => ['required'],
            'mail_from_address' => ['required', 'email'],
            'smtp_host' => ['required'],
            'type_of_encryption' => ['required', 'in:tls,ssl'],
            'smtp_username' => ['required'],
            'smtp_password' => ['required'],
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     */
    public function attributes(): array
    {
        return [
            'from_name' => 'From Name',
            'mail_from_address' => 'Mail From Address',
            'smtp_host' => 'SMTP Host',
            'smtp_port' => 'SMTP Port',
            'type_of_encryption' => 'Type of Encryption',
            'smtp_username' => 'SMTP Username',
            'smtp_password' => 'SMTP Password',
        ];
    }
}
