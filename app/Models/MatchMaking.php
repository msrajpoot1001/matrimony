<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MatchMaking extends Model
{
    use SoftDeletes;

    /**
     * Mass assignable fields
     */
    protected $fillable = [

        /* USER LINK */
        'ref_id',

        /* SYSTEM */
        'application_id',

        /* BASIC DETAILS */
        'looking_for',
        'candidate_name',
        'email',
        'gender',
        'dob',
        'height',

        /* PERSONAL & RELIGION */
        'marital_status',
        'religion',
        'caste',
        'sub_caste',
        'manglik_status',
        'interest_inter_caste',

        /* PROFESSIONAL DETAILS */
        'qualification',
        'company_name',
        'designation',
        'place_of_work',
        'year_of_experience',
        'employment_status',
        'annual_income',

        /* FAMILY DETAILS */
        'father_name',
        'father_occupation',
        'mother_name',
        'mother_occupation',
        'family_income',
        'family_status',
        'family_values',
        'living_with_family',
        'living_at',
        'ancestral_origin',

        /* HOROSCOPE */
        'birth_place',
        'birth_time',
        'kundali_details',

        /* UPLOADS */
        'full_photo',
        'govt_id_proof',
        'kundali',
    ];

    /**
     * Attribute casting
     */
    protected $casts = [
        'dob'        => 'date',
        'birth_time' => 'datetime:H:i',
        'deleted_at' => 'datetime',
    ];

    /**
     * Relationship: MatchMaking belongs to User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'ref_id');
    }

    /**
     * Auto-generate application_id
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $prefix = ($model->looking_for === 'Bride') ? 'BRD' : 'GRM';

            $lastRecord = self::whereNotNull('application_id')
                ->orderBy('id', 'desc')
                ->first();

            $newNumber = $lastRecord
                ? ((int) substr($lastRecord->application_id, 3)) + 1
                : 24851;

            $model->application_id = $prefix . $newNumber;
        });
    }
}
