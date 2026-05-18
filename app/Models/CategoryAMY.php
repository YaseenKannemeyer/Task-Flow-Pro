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

    public function tasks(): HasMany
    {
        return $this->hasMany(TaskAMY::class, 'category_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // -----------------------------------------------------------------------
    // ACCESSOR: task count
    // -----------------------------------------------------------------------
    public function getTaskCountAttribute(): int
    {
        return $this->tasks()->count();
    }

    // -----------------------------------------------------------------------
    // MUTATOR: auto-generate slug from name
    // -----------------------------------------------------------------------
    public function setNameAttribute(string $value): void
    {
        $this->attributes['name']  = $value;
        $this->attributes['slug']  = Str::slug($value);
    }
}