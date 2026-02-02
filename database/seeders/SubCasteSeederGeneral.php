<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SubCasteSeederGeneral extends Seeder
{
    public function run(): void
    {
        $castes = [
            'Bania',
            'Bhumihar',
            'Brahmin',
            'Karan',
            'Kayasth',
            'Kshatriya',
            'Komati',
            'Kubgatat',
            'Lingayat',
            'Iyengar',
            'Patel',
            'Rajput',
            'Vaishnav'
        ];

        $now = Carbon::now();
        $data = [];

        foreach ($castes as $name) {
            $data[] = [
                'name' => $name,
                'is_active' => 1,
                'ref_id' => 2, // ✅ General category
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => null,
                'deleted_by' => null,
                'delete_reason' => null,
            ];
        }

        // 🚀 Safe bulk insert
        DB::table('sub_castes')->insert($data);
    }
}
