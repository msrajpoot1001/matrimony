<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'order_no',
    'astro_product_id',
    'name',
    'phone',
    'email',
    'pincode',
    'address',
    'amount',
    'razorpay_order_id',
    'razorpay_payment_id',
    'razorpay_signature',
    'status',
        'deleted_at',
        'deleted_by',
        'delete_reason',
    ];

    /**
     * The attributes that are mass assignable.
     */

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'deleted_at' => 'datetime',
    ];
     public function product()
    {
        return $this->belongsTo(AstroProducts::class, 'astro_product_id');
    }
}
