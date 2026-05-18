<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    protected $attributes = [
        'status'         => 'pending',
        'priority'       => 'medium',
        'reminder_sent'  => false,
        'is_archived'    => false,
    ];

    // -----------------------------------------------------------------------
    // RELATIONSHIPS
    // -----------------------------------------------------------------------

    /**
     * User who created task
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Assigned user
     */
    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Task category
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(CategoryAMY::class, 'category_id');
    }

    /**
     * Task comments
     */
    public function comments(): HasMany
    {
        return $this->hasMany(TaskCommentAMY::class, 'task_id')
                    ->latest();
    }

    /**
     * Task reminders
     */
    public function reminders(): HasMany
    {
        return $this->hasMany(DeadlineReminderAMY::class, 'task_id');
    }

    /**
     * Priority relationship
     * tasks.priority -> priorities.name
     */
    public function priorityData(): BelongsTo
    {
        return $this->belongsTo(PriorityAMY::class, 'priority', 'name');
    }

    // -----------------------------------------------------------------------
    // QUERY SCOPES
    // -----------------------------------------------------------------------

    /**
     * Filter by status
     */
    public function scopeWithStatus(Builder $query, string $status): Builder
    {
        return $query->where('status', $status);
    }

    /**
     * Filter by priority
     */
    public function scopeWithPriority(Builder $query, string $priority): Builder
    {
        return $query->where('priority', $priority);
    }

    /**
     * Assigned tasks
     */
    public function scopeAssignedTo(Builder $query, int $userId): Builder
    {
        return $query->where('assigned_to', $userId);
    }

    /**
     * Created tasks
     */
    public function scopeCreatedBy(Builder $query, int $userId): Builder
    {
        return $query->where('created_by', $userId);
    }

    /**
     * Active tasks
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_archived', false);
    }

    /**
     * Completed tasks
     */
    public function scopeCompleted(Builder $query): Builder
    {
        return $query->where('status', 'completed');
    }

    /**
     * Overdue tasks
     */
    public function scopeOverdue(Builder $query): Builder
    {
        return $query->whereDate('due_date', '<', Carbon::today())
                     ->whereNotIn('status', ['completed', 'cancelled']);
    }

    /**
     * Tasks due soon
     */
    public function scopeDueSoon(Builder $query, int $days = 3): Builder
    {
        return $query->whereBetween('due_date', [
                        Carbon::today(),
                        Carbon::today()->addDays($days)
                    ])
                    ->whereNotIn('status', ['completed', 'cancelled']);
    }

    /**
     * Pending reminders
     */
    public function scopePendingReminder(Builder $query): Builder
    {
        return $query->whereDate('due_date', Carbon::tomorrow())
                     ->where('reminder_sent', false)
                     ->whereNotIn('status', ['completed', 'cancelled']);
    }

    // -----------------------------------------------------------------------
    // ACCESSORS
    // -----------------------------------------------------------------------

    /**
     * Human-readable status
     */
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

    /**
     * Human-readable priority
     */
    public function getPriorityLabelAttribute(): string
    {
        return ucfirst($this->priority);
    }

    /**
     * Status badge classes
     */
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

    /**
     * Priority badge classes
     */
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

    /**
     * Is overdue?
     */
    public function getIsOverdueAttribute(): bool
    {
        return $this->due_date
            && $this->due_date->isPast()
            && !in_array($this->status, ['completed', 'cancelled']);
    }

    /**
     * Days remaining
     */
    public function getDaysRemainingAttribute(): ?int
    {
        return $this->due_date
            ? Carbon::today()->diffInDays($this->due_date, false)
            : null;
    }

    /**
     * Completion percentage
     */
    public function getProgressPercentageAttribute(): int
    {
        return match ($this->status) {
            'pending'     => 0,
            'in_progress' => 50,
            'completed'   => 100,
            'cancelled'   => 0,
            default       => 0,
        };
    }

    // -----------------------------------------------------------------------
    // MUTATORS
    // -----------------------------------------------------------------------

    /**
     * Format title
     */
    public function setTitleAttribute(string $value): void
    {
        $this->attributes['title'] = ucwords(
            strtolower(trim($value))
        );
    }

    /**
     * Auto timestamps from status
     */
    public function setStatusAttribute(string $value): void
    {
        $this->attributes['status'] = $value;

        if (
            $value === 'completed'
            && empty($this->attributes['completed_at'])
        ) {
            $this->attributes['completed_at'] = now();
        }

        if (
            $value === 'in_progress'
            && empty($this->attributes['started_at'])
        ) {
            $this->attributes['started_at'] = now();
        }
    }
}