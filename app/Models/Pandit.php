<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pandit extends Model
{
    //
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_type',
         'name',
        'email',
        'gender',
        'dob',
        'contact_number',
        'whatsapp_number',
        'qualification',
        'experience_years',
        'location',
        'services_offered',
        'other_service',
        'add_require',
        'deleted_at',
        'deleted_by',
        'delete_reason',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'deleted_at' => 'datetime',
        'services_offered' => 'array',
    ];
}
