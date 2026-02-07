<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FoodCatering extends Model
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
        'whatsapp_number',
        'qualification',
        'experience_years',
        'location',
        'looking_for',
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
     * FoodCatering belongs to User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'ref_id');
    }
}
