<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
class UserProfile extends Model
{
       use SoftDeletes;
    // Table name (optional, Laravel can infer it from model name)
    protected $table = 'user_profiles';

    // Mass assignable fields
    protected $fillable = [
        'user_id',
        'education'
    ];

    // Cast 'address' JSON to array automatically
    protected $casts = [
        'height'  => 'decimal:2',
    ];

    /**
     * Relationship to User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
