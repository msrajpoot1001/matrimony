<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pandit extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'ref_id',
        'user_type',
        'name',
        'gender',
        'dob',
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

    protected $casts = [
        'dob'              => 'date',
        'services_offered' => 'array',
        'deleted_at'       => 'datetime',
    ];

    /**
     * 🔗 Pandit belongs to User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'ref_id');
    }
}
