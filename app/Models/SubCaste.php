<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCaste extends Model
{
    protected $fillable = ['name', 'is_active', 'ref_id'];
    public function caste()
    {
        return $this->belongsTo(Caste::class, 'ref_id');
    }

    public function subCategories()
    {
        return $this->hasMany(SubCaste::class, 'ref_id');
    }

}