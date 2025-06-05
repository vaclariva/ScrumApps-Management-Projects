<?php

namespace App\Http\Requests\CheckDev;

use Illuminate\Foundation\Http\FormRequest;

class StoreCheckDevRequest extends FormRequest
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
            'dev_id' => 'required|exists:developments,id',
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'status' => 'nullable|in:inactive,active',
        ];
    }
}
