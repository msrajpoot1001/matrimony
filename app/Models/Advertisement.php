<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advertisement extends Model {
    protected $fillable = ['photo', 'heading', 'sub_heading', 'description', 'is_active','deleted_at',
        'deleted_by',
        'delete_reason',];
    //
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'deleted_at' => 'datetime',
    ];
}
