<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SeoPagesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('seo_pages')->insert([
            [
                'page_name'   => 'home',
                'title'       => 'Home Page',
                'description' => 'Welcome to our website home page.',
                'keywords'    => 'home, landing, main',
                'is_active'   => 1,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],
            [
                'page_name'   => 'contact',
                'title'       => 'Contact Us',
                'description' => 'Get in touch with us through our contact page.',
                'keywords'    => 'contact, support, help',
                'is_active'   => 1,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],
            [
                'page_name'   => 'about',
                'title'       => 'About Us',
                'description' => 'Learn more about our company and mission.',
                'keywords'    => 'about, company, mission',
                'is_active'   => 1,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],
        ]);
    }
}
