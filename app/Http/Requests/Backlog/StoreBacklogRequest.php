<?php

namespace App\Http\Requests\Backlog;

use Illuminate\Foundation\Http\FormRequest;

class StoreBacklogRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|string|max:255',
            'status' => 'nullable|in:active,inactive',
            'applicant' => 'nullable|string|max:255',
            'sprint_id' => 'nullable|exists:sprints,id',
            'project_id' => 'required|exists:projects,id',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
