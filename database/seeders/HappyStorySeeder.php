<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HappyStorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        DB::table('happy_stories')->insert([
            [
                'photo' => 'upload/happy_stories/sample.jpg',
                'reason' => 'Sample reason',
                'heading' => 'Sample heading',
                'sub_heading' => 'Sample sub_heading',
                'date' => 'Sample date',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
