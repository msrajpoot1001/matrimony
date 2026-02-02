<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class KarmaTrainingContent extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'photo',
        'short_description',
        'description',
        'author_name',
        'author_photo',
        'author_description',
        'is_active',
        'deleted_at',
        'deleted_by',
        'delete_reason',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    /**
     * Automatically create/update slug from title
     */
    protected static function booted()
    {
        static::creating(function ($model) {
            $model->slug = static::generateUniqueSlug($model->title);
        });

        static::updating(function ($model) {
            if ($model->isDirty('title')) {
                $model->slug = static::generateUniqueSlug($model->title, $model->id);
            }
        });
    }

    /**
     * Generate unique slug
     */
    protected static function generateUniqueSlug($title, $ignoreId = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        while (
            static::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $count++;
        }

        return $slug;
    }
}
