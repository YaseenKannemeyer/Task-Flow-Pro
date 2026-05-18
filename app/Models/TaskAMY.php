<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class TaskAMY extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tasks';

    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'category_id',
        'created_by',
        'assigned_to',
        'due_date',
        'started_at',
        'completed_at',
        'reminder_sent',
        'is_archived',
    ];

    protected $casts = [
        'due_date'      => 'date',
        'started_at'    => 'datetime',
        'completed_at'  => 'datetime',
        'reminder_sent' => 'boolean',
        'is_archived'   => 'boolean',
    ];

    // -----------------------------------------------------------------------
    // RELATIONSHIPS
    // -----------------------------------------------------------------------

    /** Task belongs to the user who created it */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /** Task belongs to the assigned user (nullable) */
    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /** Task belongs to one category */
    public function category(): BelongsTo
    {
        return $this->belongsTo(CategoryAMY::class, 'category_id');
    }

    /** Task has many comments */
    public function comments(): HasMany
    {
        return $this->hasMany(TaskCommentAMY::class, 'task_id')->latest();
    }

    // -----------------------------------------------------------------------
    // QUERY SCOPES
    // -----------------------------------------------------------------------

    /** Filter by status */
    public function scopeWithStatus(Builder $query, string $status): Builder
    {
        return $query->where('status', $status);
    }

    /** Filter by priority */
    public function scopeWithPriority(Builder $query, string $priority): Builder
    {
        return $query->where('priority', $priority);
    }

    /** Tasks assigned to a specific user */
    public function scopeAssignedTo(Builder $query, int $userId): Builder
    {
        return $query->where('assigned_to', $userId);
    }

    /** Tasks created by a specific user */
    public function scopeCreatedBy(Builder $query, int $userId): Builder
    {
        return $query->where('created_by', $userId);
    }

    /** Tasks that are overdue (past due_date and not completed) */
    public function scopeOverdue(Builder $query): Builder
    {
        return $query->where('due_date', '<', Carbon::today())
                     ->whereNotIn('status', ['completed', 'cancelled']);
    }

    /** Tasks due within the next N days */
    public function scopeDueSoon(Builder $query, int $days = 3): Builder
    {
        return $query->whereBetween('due_date', [Carbon::today(), Carbon::today()->addDays($days)])
                     ->whereNotIn('status', ['completed', 'cancelled']);
    }

    /** Only active (non-archived) tasks */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_archived', false);
    }

    /** Pending reminder tasks (due tomorrow, reminder not sent) */
    public function scopePendingReminder(Builder $query): Builder
    {
        return $query->where('due_date', Carbon::tomorrow())
                     ->where('reminder_sent', false)
                     ->whereNotIn('status', ['completed', 'cancelled']);
    }

    // -----------------------------------------------------------------------
    // ACCESSORS
    // -----------------------------------------------------------------------

    /** Human-readable status label */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending'     => 'Pending',
            'in_progress' => 'In Progress',
            'completed'   => 'Completed',
            'cancelled'   => 'Cancelled',
            default       => ucfirst($this->status),
        };
    }

    /** Human-readable priority label */
    public function getPriorityLabelAttribute(): string
    {
        return ucfirst($this->priority);
    }

    /** Tailwind CSS classes for status badge */
    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'pending'     => 'bg-yellow-100 text-yellow-800',
            'in_progress' => 'bg-blue-100 text-blue-800',
            'completed'   => 'bg-green-100 text-green-800',
            'cancelled'   => 'bg-gray-100 text-gray-600',
            default       => 'bg-gray-100 text-gray-600',
        };
    }

    /** Tailwind CSS classes for priority badge */
    public function getPriorityColorAttribute(): string
    {
        return match ($this->priority) {
            'low'      => 'bg-slate-100 text-slate-600',
            'medium'   => 'bg-orange-100 text-orange-700',
            'high'     => 'bg-red-100 text-red-700',
            'critical' => 'bg-red-600 text-white',
            default    => 'bg-gray-100 text-gray-600',
        };
    }

    /** Is this task overdue? */
    public function getIsOverdueAttribute(): bool
    {
        return $this->due_date
            && $this->due_date->isPast()
            && !in_array($this->status, ['completed', 'cancelled']);
    }

    /** Days remaining until due date (negative = overdue) */
    public function getDaysRemainingAttribute(): ?int
    {
        return $this->due_date
            ? (int) Carbon::today()->diffInDays($this->due_date, false)
            : null;
    }

    // -----------------------------------------------------------------------
    // MUTATORS
    // -----------------------------------------------------------------------

    /** Auto-capitalize title */
    public function setTitleAttribute(string $value): void
    {
        $this->attributes['title'] = ucwords(strtolower(trim($value)));
    }

    /** Set completed_at automatically when status becomes 'completed' */
    public function setStatusAttribute(string $value): void
    {
        $this->attributes['status'] = $value;

        if ($value === 'completed' && is_null($this->completed_at)) {
            $this->attributes['completed_at'] = now();
        }

        if ($value === 'in_progress' && is_null($this->started_at)) {
            $this->attributes['started_at'] = now();
        }
    }
}