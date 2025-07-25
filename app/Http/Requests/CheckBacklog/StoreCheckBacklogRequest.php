<?php

namespace App\Http\Requests\CheckBacklog;

use Illuminate\Foundation\Http\FormRequest;

class StoreCheckBacklogRequest extends FormRequest
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
            'backlog_id' => 'required|exists:backlogs,id',
            'name'       => 'required|string|max:1000',
            'status'     => 'nullable|in:active,inactive',
        ];
    }
}
