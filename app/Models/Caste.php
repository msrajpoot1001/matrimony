<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Caste extends Model {
    protected $fillable = ['name', 'is_active',  'deleted_at',
        'deleted_by',
        'delete_reason',];
    public function subCastes()
    {
        return $this->hasMany(SubCaste::class);
    }

    //
    use SoftDeletes;

   
    protected $casts = [
        'deleted_at' => 'datetime',
    ];
}
