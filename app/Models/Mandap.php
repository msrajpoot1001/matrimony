<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mandap extends Model
{
    //
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_type',
        'mandap_for',
        'user_type',
        'other_event',
        'full_name',
        'email',
        'gender',
        'dob',
        'contact_number',
        'whatsapp_number',
        'place_name',
        'guest_count',
        'location',
        'preferred_date',
        'venue_category',
        'additional_requirements',
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
