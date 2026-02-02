<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasDeleteMeta;

class PaymentGateway extends Model
{
    use SoftDeletes, HasDeleteMeta;

    protected $table = 'payment_gateways'; // ✅ match your real table name

    protected $fillable = [
        'gateway_name',
        'key',
        'secreat',
        'type',
        'is_active',

        // ✅ soft delete meta columns
        'deleted_by',
        'delete_reason',
        // (deleted_at is handled automatically by SoftDeletes)
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
        'deleted_by' => 'integer',
        'is_active'  => 'boolean',
    ];

    /**
     * Optional: which user deleted this gateway
     */
    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
