<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Support\Str;

class CategoryAMY extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'color',
        'description',
        'created_by',
    ];

    // -----------------------------------------------------------------------
    // RELATIONSHIPS
    // -----------------------------------------------------------------------

    /**
     * Category tasks
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(TaskAMY::class, 'category_id');
    }

    /**
     * User who created category
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // -----------------------------------------------------------------------
    // ACCESSORS
    // -----------------------------------------------------------------------

    /**
     * Total tasks in category
     */
    public function getTaskCountAttribute(): int
    {
        return $this->tasks()->count();
    }

    /**
     * Active tasks only
     */
    public function getActiveTaskCountAttribute(): int
    {
        return $this->tasks()
                    ->where('is_archived', false)
                    ->count();
    }

    // -----------------------------------------------------------------------
    // MUTATORS
    // -----------------------------------------------------------------------

    /**
     * Auto-generate slug
     */
    public function setNameAttribute(string $value): void
    {
        $this->attributes['name'] = ucwords(trim($value));

        $this->attributes['slug'] = Str::slug($value);
    }
}