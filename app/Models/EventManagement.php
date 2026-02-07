<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventManagement extends Model
{
    use SoftDeletes;

    protected $table = 'event_managements';

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
        'experience_years',
        'location',
        'services_offered',
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
     * EventManagement belongs to User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'ref_id');
    }
}
