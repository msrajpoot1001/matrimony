<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CompanyInfo;

class CompanyInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompanyInfo::create([
            // 1️⃣ Company Basic Info
            'company_name'   => 'Company Name',
            'client_name'    => 'Manish Singh',
            'title'          => 'Title of Company',
            'description'    => 'Description of Company',

            // 2️⃣ Emails
            'email1'         => 'info@metafox.com',
            'email2'         => 'support@metafox.com',
            'email3'         => 'sales@metafox.com',

            // 3️⃣ Phones
            'phone1'         => '+91 9876543210',
            'phone2'         => '+91 9123456789',
            'phone3'         => '+91 9988776655',

            // 4️⃣ Addresses
            'address1'       => 'address1',
            'address2'       => 'address2',
            'address3'       => 'address2',

            // 5️⃣ Social Links
            'facebook'       => 'https://facebook.com/metafox',
            'instagram'      => 'https://instagram.com/metafox',
            'twitter'        => 'https://twitter.com/metafox',
            'youtube'        => 'https://youtube.com/metafox',
            'linkedin'       => 'https://linkedin.com/company/metafox',
            'pinterest'      => 'https://pinterest.com/metafox',

            // 6️⃣ Website
            'website_url'    => 'https://www.metafox.com',

            // 7️⃣ Files
            'logo'           => '',
            'favicon'        => '',
            'brochure'       => '',
        ]);
    
    }
}
