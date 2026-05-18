@component('mail::message')
# Task Deadline Reminder

Hi **{{ $recipient->name }}**,

This is a friendly reminder that the following task is due **tomorrow ({{ $dueDate }})**.

@component('mail::panel')
**{{ $task->title }}**
Priority: {{ $task->priority_label }}
Status: {{ $task->status_label }}
@endcomponent

Please ensure the task is updated or completed before the deadline.

@component('mail::button', ['url' => route('tasks.show', $task), 'color' => 'primary'])
View Task
@endcomponent

Thanks,
{{ config('app.name') }}
@endcomponent