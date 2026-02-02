<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class AstroProducts extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'photo',
        'name',
        'slug',
        'price',
        'short_description',
        'description',
        'is_active',
        'deleted_at',
        'deleted_by',
        'delete_reason',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    /**
     * Automatically create/update slug from name
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);
        });

        static::updating(function ($product) {
            if ($product->isDirty('name')) {
                $product->slug = Str::slug($product->name);
            }
        });
    }
}
