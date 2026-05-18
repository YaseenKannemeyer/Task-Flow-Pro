<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTaskRequestAMY extends FormRequest
{
    /** Only authenticated team_members and admins can submit this form */
    public function authorize(): bool
    {
        $user = $this->user();
        return $user && ($user->isAdmin() || $user->isTeamMember());
    }

    public function rules(): array
    {
        return [
            'title'       => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'status'      => ['required', Rule::in(['pending', 'in_progress', 'completed', 'cancelled'])],
            'priority'    => ['required', Rule::in(['low', 'medium', 'high', 'critical'])],
            'category_id' => ['nullable', 'exists:categories,id'],
            'assigned_to' => ['nullable', 'exists:users,id'],
            'due_date'    => ['nullable', 'date', 'after_or_equal:today'],
        ];
    }

    /** Custom human-friendly error messages */
    public function messages(): array
    {
        return [
            'title.required'       => 'Please enter a task title.',
            'title.min'            => 'The task title must be at least 3 characters.',
            'status.in'            => 'Please select a valid status.',
            'priority.in'          => 'Please select a valid priority.',
            'category_id.exists'   => 'The selected category does not exist.',
            'assigned_to.exists'   => 'The selected user does not exist.',
            'due_date.after_or_equal' => 'The due date cannot be in the past.',
        ];
    }

    /** Custom attribute names for cleaner error messages */
    public function attributes(): array
    {
        return [
            'category_id' => 'category',
            'assigned_to' => 'assignee',
            'due_date'    => 'due date',
        ];
    }
}
