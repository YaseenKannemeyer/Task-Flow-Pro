<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequestAMY extends FormRequest
{
    public function authorize(): bool
    {
        // Any authenticated user who can view the task can comment
        $task = $this->route('task');
        return $this->user()->can('view', $task);
    }

    public function rules(): array
    {
        return [
            'body' => ['required', 'string', 'min:2', 'max:2000'],
        ];
    }

    public function messages(): array
    {
        return [
            'body.required' => 'Comment cannot be empty.',
            'body.min'      => 'Comment must be at least 2 characters.',
        ];
    }
}
