<?php

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