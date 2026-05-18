<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaskRequestAMY extends FormRequest
{
    public function authorize(): bool
    {
        $task = $this->route('task');
        return $this->user()->can('update', $task);
    }

    public function rules(): array
    {
        return [
            'title'       => ['sometimes', 'required', 'string', 'min:3', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'status'      => ['sometimes', 'required', Rule::in(['pending', 'in_progress', 'completed', 'cancelled'])],
            'priority'    => ['sometimes', 'required', Rule::in(['low', 'medium', 'high', 'critical'])],
            'category_id' => ['nullable', 'exists:categories,id'],
            'assigned_to' => ['nullable', 'exists:users,id'],
            'due_date'    => ['nullable', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Please enter a task title.',
            'title.min'      => 'The task title must be at least 3 characters.',
        ];
    }
}