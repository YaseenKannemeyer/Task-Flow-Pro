<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
        'role_id', 'avatar', 'is_active', 'last_login_at',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at'     => 'datetime',
        'password'          => 'hashed',
        'is_active'         => 'boolean',
    ];

    // -----------------------------------------------------------------------
    // RELATIONSHIPS
    // -----------------------------------------------------------------------

    public function role(): BelongsTo
    {
        return $this->belongsTo(RoleXYZ::class, 'role_id');
    }

    public function createdTasks(): HasMany
    {
        return $this->hasMany(TaskXYZ::class, 'created_by');
    }

    public function assignedTasks(): HasMany
    {
        return $this->hasMany(TaskXYZ::class, 'assigned_to');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(TaskCommentXYZ::class, 'user_id');
    }

    // -----------------------------------------------------------------------
    // ROLE HELPERS
    // -----------------------------------------------------------------------

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

    // -----------------------------------------------------------------------
    // ACCESSOR
    // -----------------------------------------------------------------------

    /** Returns initials for avatar fallback */
    public function getInitialsAttribute(): string
    {
        $parts = explode(' ', $this->name);
        return strtoupper(substr($parts[0], 0, 1) . (substr($parts[1] ?? '', 0, 1)));
    }
}


// =============================================================================
// FILE: app/Models/RoleXYZ.php
// =============================================================================
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoleXYZ extends Model
{
    protected $table = 'roles';

    protected $fillable = ['name', 'display_name', 'description'];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'role_id');
    }
}