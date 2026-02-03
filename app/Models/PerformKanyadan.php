<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PerformKanyadan extends Model
{
    use SoftDeletes;

    /**
     * Mass assignable fields
     */
    protected $fillable = [
        'ref_id',
        'donor_name',
        'gender',
        'dob',
        'contact_number',
        'whatsapp_number',
        'location',
        'kanyadan_type',
        'donation_amount',
        'other_kanyadan',
        'blessings',
    ];

    /**
     * Casts
     */
    protected $casts = [
        'dob'        => 'date',
        'deleted_at' => 'datetime',
    ];

    /**
     * PerformKanyadan belongs to User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'ref_id');
    }
}
