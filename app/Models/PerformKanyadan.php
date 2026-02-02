<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PerformKanyadan extends Model
{
    //
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    //  'user_type',
    protected $fillable = [
       
       'donor_name',
        'email',
        'gender',
        'dob',
        'contact_number',
        'whatsapp_number',
        'kanyadan_type',
        'donation_amount',
        'transction_id',
        'other_kanyadan',
        'blessings',
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
