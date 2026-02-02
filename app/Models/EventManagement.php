<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventManagement extends Model
{
    use SoftDeletes;

    // 🔥 THIS LINE FIXES THE ERROR
    protected $table = 'event_managements';

    protected $fillable = [
        'user_type',
        'full_name',
        'email',
        'gender',
        'dob',
        'contact_number',
        'whatsapp_number',
        'experience_years',
        'location',
        'services_offered',
        'other_service',
        'add_require',
        'deleted_at',
        'deleted_by',
        'delete_reason',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];
}
