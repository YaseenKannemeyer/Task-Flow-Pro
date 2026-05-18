<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // -------------------------------------------------------------------
    // MASS ASSIGNMENT
    // -------------------------------------------------------------------

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // -------------------------------------------------------------------
    // RELATIONSHIPS
    // -------------------------------------------------------------------

    /**
     * Role of user
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(RoleAMY::class, 'role_id');
    }

    /**
     * Tasks created by user
     */
    public function createdTasks(): HasMany
    {
        return $this->hasMany(TaskAMY::class, 'created_by');
    }

    /**
     * Tasks assigned to user
     */
    public function assignedTasks(): HasMany
    {
        return $this->hasMany(TaskAMY::class, 'assigned_to');
    }

    /**
     * Comments made by user
     */
    public function taskComments(): HasMany
    {
        return $this->hasMany(TaskCommentAMY::class, 'user_id');
    }

    /**
     * Deadline reminders for user
     */
    public function reminders(): HasMany
    {
        return $this->hasMany(DeadlineReminderAMY::class, 'user_id');
    }

    /**
     * Categories created by user
     */
    public function categories(): HasMany
    {
        return $this->hasMany(CategoryAMY::class, 'created_by');
    }

    // -------------------------------------------------------------------
    // ROLE HELPERS (IMPORTANT FOR YOUR SYSTEM)
    // -------------------------------------------------------------------

    public function isAdmin(): bool
    {
        return $this->role?->name === 'admin';
    }

    public function isTeamMember(): bool
    {
        return $this->role?->name === 'team_member';
    }

    public function isGuest(): bool
    {
        return $this->role?->name === 'guest';
    }

    // -------------------------------------------------------------------
    // ACCESSORS
    // -------------------------------------------------------------------

    public function getRoleNameAttribute(): ?string
    {
        return $this->role?->name;
    }

    public function getRoleDisplayAttribute(): ?string
    {
        return $this->role?->display_name;
    }
}