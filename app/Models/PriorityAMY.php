<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Carbon\Carbon;

class DeadlineReminderAMY extends Model
{
    use HasFactory;

    protected $table = 'deadline_reminders';

    protected $fillable = [
        'task_id',
        'user_id',
        'message',
        'reminder_date',
        'is_sent',
        'sent_at',
    ];

    protected $casts = [
        'reminder_date' => 'datetime',
        'sent_at'       => 'datetime',
        'is_sent'       => 'boolean',
    ];

    // -----------------------------------------------------------------------
    // RELATIONSHIPS
    // -----------------------------------------------------------------------

    /**
     * Related task
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(TaskAMY::class, 'task_id');
    }

    /**
     * Related user
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // -----------------------------------------------------------------------
    // QUERY SCOPES
    // -----------------------------------------------------------------------

    /**
     * Pending reminders
     */
    public function scopePending(Builder $query): Builder
    {
        return $query->where('is_sent', false);
    }

    /**
     * Sent reminders
     */
    public function scopeSent(Builder $query): Builder
    {
        return $query->where('is_sent', true);
    }

    /**
     * Due reminders
     */
    public function scopeDue(Builder $query): Builder
    {
        return $query->where('reminder_date', '<=', Carbon::now())
                     ->where('is_sent', false);
    }

    // -----------------------------------------------------------------------
    // ACCESSORS
    // -----------------------------------------------------------------------

    /**
     * Is reminder pending?
     */
    public function getIsPendingAttribute(): bool
    {
        return !$this->is_sent
            && now()->gte($this->reminder_date);
    }

    /**
     * Formatted reminder date
     */
    public function getFormattedReminderDateAttribute(): ?string
    {
        return $this->reminder_date
            ? $this->reminder_date->format('d M Y H:i')
            : null;
    }
}