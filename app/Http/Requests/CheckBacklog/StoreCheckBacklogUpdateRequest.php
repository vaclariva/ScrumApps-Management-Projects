<?php

namespace App\Http\Requests\CheckBacklog;

use Illuminate\Foundation\Http\FormRequest;

class StoreCheckBacklogUpdateRequest extends FormRequest
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
    public function rules()
    {
        return [
            'backlog_id' => 'sometimes|exists:backlogs,id',
            'name'       => 'sometimes|string|max:1000',
            'status'     => 'nullable|in:active,inactive',
        ];
    }
}
