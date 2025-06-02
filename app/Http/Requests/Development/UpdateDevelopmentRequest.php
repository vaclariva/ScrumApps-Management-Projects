<?php

namespace App\Http\Requests\Development;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDevelopmentRequest extends FormRequest
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
            'name' => 'nullable|string|max:255',
            'desc' => 'nullable|string',
            'link' => 'nullable|url|max:255',
            'file' => 'sometimes|nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,zip',
            'status' => 'nullable|in:todo,in_progress,qa,done',
            'project_id' => 'required|exists:projects,id',
        ];
    }
}
