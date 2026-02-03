<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;   // ✅ add this

class User extends Authenticatable
{
    use HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'contact_number',
        'role', // stores user_roles.id
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relationship: User has many addresses
     */
    public function addresses()
    {
        return $this->hasMany(Address::class, 'user_id');
    }

    /**
     * Relationship: User has one profile
     */
    public function profile()
    {
        return $this->hasOne(UserProfile::class, 'user_id');
    }

    /**
     * Relationship with UserRole
     */
    public function userRole()
    {
        return $this->belongsTo(UserRole::class, 'role', 'id');
    }

    public function astrologies()
{
    return $this->hasMany(Astrology::class, 'ref_id');
}

public function mandaps()
{
    return $this->hasMany(Mandap::class, 'ref_id');
}


}
