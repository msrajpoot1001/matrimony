<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PaymentGatewaysSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('payment_gateways')->insert([
            [
                'gateway_name' => 'razorpay',
                'key'          => null,   // add key later
                'secreat'      => null,   // add secret later (column name is secreat in migration)
                'is_active'    => 1,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'gateway_name' => 'cashfree',
                'key'          => null,
                'secreat'      => null,
                'is_active'    => 1,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
        ]);
    }
}
