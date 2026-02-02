<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model {
    protected $fillable = ['photo', 'name', 'position', 'quali', 'description','deleted_at',
        'deleted_by',
        'delete_reason', 'is_active'];
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
