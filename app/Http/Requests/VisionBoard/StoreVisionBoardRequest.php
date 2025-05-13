<?php

namespace App\Http\Requests\VisionBoard;

use Illuminate\Foundation\Http\FormRequest;

class StoreVisionBoardRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'vision' => ['nullable', 'string'],
            'target_group' => ['nullable', 'string'],
            'needs' => ['nullable', 'string'],
            'products' => ['nullable', 'string'],
            'business_goals' => ['nullable', 'string'],
            'competitors' => ['nullable', 'string'],
            'project_id' => ['required', 'exists:projects,id'],
        ];
    }
}
