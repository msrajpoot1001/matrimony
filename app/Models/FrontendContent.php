<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FrontendContent extends Model
{
    //
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'query_form',
        'chat_bot',
        'experience',
        'active_members',
        'successfull_marriage',
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
