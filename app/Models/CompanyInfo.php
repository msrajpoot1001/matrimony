<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes; 
class CompanyInfo extends Model
{
     use HasFactory;

     protected $fillable = [
        // 1️⃣ Company Basic Info
        'company_name',
        'client_name',
        'title',
        'description',

        // 2️⃣ Emails
        'email1',
        'email2',
        'email3',

        // 3️⃣ Phones
        'phone1',
        'phone2',
        'phone3',

        // 4️⃣ Addresses
        'address1',
        'address2',
        'address3',

        // 5️⃣ Social Links
        'facebook',
        'instagram',
        'twitter',
        'youtube',
        'linkedin',
        'pinterest',

        // 6️⃣ Website
        'website_url',
         'google_map_location',
         'google_map_link',

        // 7️⃣ Files
        'logo',
        'favicon',
        'brochure',

    ];

}

