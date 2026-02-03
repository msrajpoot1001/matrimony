<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Support extends Model
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
        'contribution_type',
        'amount',
        'transction_id',
        'other_contribution',
        'message',
    ];

    /**
     * Casts
     */
    protected $casts = [
        'dob'        => 'date',
        'deleted_at' => 'datetime',
    ];

    /**
     * Support belongs to User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'ref_id');
    }
}
