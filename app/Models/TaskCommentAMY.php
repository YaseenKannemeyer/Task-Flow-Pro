<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskCommentAMY extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'task_comments';

    protected $fillable = [
        'task_id',
        'user_id',
        'body',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
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
     * Comment author
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // -----------------------------------------------------------------------
    // QUERY SCOPES
    // -----------------------------------------------------------------------

    /**
     * Latest comments
     */
    public function scopeLatestFirst(Builder $query): Builder
    {
        return $query->latest();
    }

    // -----------------------------------------------------------------------
    // ACCESSORS
    // -----------------------------------------------------------------------

    /**
     * Short preview of comment
     */
    public function getExcerptAttribute(): string
    {
        return str($this->body)->limit(80);
    }

    /**
     * Formatted created date
     */
    public function getFormattedDateAttribute(): ?string
    {
        return $this->created_at
            ? $this->created_at->format('d M Y H:i')
            : null;
    }

    // -----------------------------------------------------------------------
    // MUTATORS
    // -----------------------------------------------------------------------

    /**
     * Clean comment body
     */
    public function setBodyAttribute(string $value): void
    {
        $this->attributes['body'] = trim($value);
    }
}