<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KarmaTraining extends Model
{
    use SoftDeletes;

    /**
     * Mass assignable fields
     */
    protected $fillable = [
        'ref_id',
        'user_type',
        'full_name',
        'gender',
        'dob',
        'contact_number',
        'whatsapp_number',
        'qualification',
        'experience_years',
        'location',
        'other_service',
        'add_require',
    ];

    /**
     * Casts
     */
    protected $casts = [
        'dob'        => 'date',
        'deleted_at' => 'datetime',
    ];

    /**
     * KarmaTraining belongs to User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'ref_id');
    }
}
