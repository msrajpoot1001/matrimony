<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HappyStory extends Model {
    protected $fillable = ['photo', 'reason', 'heading', 'sub_heading', 'date', 'is_active', 'deleted_at',
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
        'date' => 'date',
        'deleted_at' => 'datetime',
    ];
}
