<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mandap extends Model
{
    use SoftDeletes;

    /**
     * Mass assignable fields
     */
    protected $fillable = [
        'ref_id',
        'user_type',
        'mandap_for',
        'other_event',
        'full_name',
        'gender',
        'dob',
        'whatsapp_number',
        'place_name',
        'guest_count',
        'location',
        'preferred_date',
        'venue_category',
        'additional_requirements',
    ];

    /**
     * Casts
     */
    protected $casts = [
        'dob'            => 'date',
        'preferred_date' => 'date',
        'deleted_at'     => 'datetime',
    ];

    /**
     * Mandap belongs to User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'ref_id');
    }
}
