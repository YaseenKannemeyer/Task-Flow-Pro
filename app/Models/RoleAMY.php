<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;

class RoleAMY extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = [
        'name',
        'display_name',
        'description',
    ];

    // -----------------------------------------------------------------------
    // RELATIONSHIPS
    // -----------------------------------------------------------------------

    /**
     * Users assigned to this role
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'role_id');
    }

    // -----------------------------------------------------------------------
    // ACCESSORS
    // -----------------------------------------------------------------------

    /**
     * Formatted role name
     */
    public function getFormattedNameAttribute(): string
    {
        return $this->display_name
            ?? ucfirst($this->name);
    }

    /**
     * Is admin role?
     */
    public function getIsAdminAttribute(): bool
    {
        return strtolower($this->name) === 'admin';
    }

    /**
     * Is team member role?
     */
    public function getIsTeamMemberAttribute(): bool
    {
        return strtolower($this->name) === 'team_member';
    }

    /**
     * Is guest role?
     */
    public function getIsGuestAttribute(): bool
    {
        return strtolower($this->name) === 'guest';
    }
}