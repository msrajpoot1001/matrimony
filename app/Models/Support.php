<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Support extends Model
{
    //
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_type',
        'full_name',
        'email',
        'gender',
        'dob',
        'contact_number',
        'whatsapp_number',
        'contribution_type',
        'amount',
        'transction_id',
        'other_contribution',
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
