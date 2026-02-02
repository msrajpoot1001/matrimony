<?php

namespace Database\Seeders;

use App\Models\CompanyInfo;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\ContentPagesContentsSeeder;
use Database\Seeders\UserRoleSeeder;
use Database\Seeders\PaymentGatewaysSeeder;
use Database\Seeders\SeoPagesSeeder;





class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserRoleSeeder::class);
        $this->call([CompanyInfoSeeder::class,]);
        $this->call(ContentPagesContentsSeeder::class);
        $this->call(PaymentGatewaysSeeder::class);
        $this->call(SeoPagesSeeder::class);
        
        
    }
}
