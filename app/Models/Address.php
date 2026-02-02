<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes;

    // Table name (optional; Laravel can infer)
    protected $table = 'addresses';

    // Mass assignable fields
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'street',
        'landmark',
        'city',
        'state',
        'country',
        'postal_code',
        'type',

        // soft delete extra columns
        'deleted_by',
        'delete_reason',
        // NOTE: usually you don't include deleted_at in fillable
        // because Laravel manages it automatically.
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
        'deleted_by' => 'integer',
    ];

    /**
     * User relationship
     * An address belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Optional: who deleted this address
     */
    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    /**
     * Scope to get main address
     */
    public function scopeMain($query)
    {
        return $query->where('type', 'main');
    }
}
