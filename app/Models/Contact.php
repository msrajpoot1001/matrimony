<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    //
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
       'name',
       'type',
        'email',
        'phone',
        'subject',
        'message',
        'deleted_at',
        'deleted_by',
        'delete_reason',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'deleted_at' => 'datetime',
    ];
}
