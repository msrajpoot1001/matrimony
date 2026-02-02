<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SubCasteSeederSC extends Seeder
{
    public function run(): void
    {
        $castes = [
            'Adi-Andhra','Amant','Amat','Dandachhatra Majhi','Amata','Amath','Audhelia','Badaik',
            'Bagheti','Baghuti','Bajikar','Bari','Basor','Burud','Bauri','Buna Bauri','Dasia Bauri',
            'Bauti','Bavuri','Bedia','Bejia','Bajia','Beldar','Bhata','Bhoi','Chachti','Chakali',
            'Chamar','Mochi','Muchi','Satnami','Chamara','Chamar-Ravidas','Chamar-Rohidas',
            'Chandala','Chandhai Maru','Dandasi','Dewar','Dhibara','Keuta','Kaibarta','Dhanwar',
            'Dhoba','Dhobi','Rajak','Rajaka','Dom','Dombo','Duria Dom','Adhuria Dom',
            'Adhuria Domb','Dosadha','Ganda','Ghantaraghada','Ghantra','Ghasi','Ghasia',
            'Ghogia','Ghusuria','Godagali','Godari','Godra','Gokha','Gorait','Korait',
            'Haddi','Hari','Irika','Jaggali','Jagli','Kandra','Kandara','Kadama','Kuduma',
            'Kodma','Kodama','Karua','Katia','Khatia','Kela','Sapua Kela','Nalua Kela',
            'Sabakhia Kela','Gaudia Kela','Khadala','Khadal','Khodal','Kodalo','Kori',
            'Kurunga','Laban','Laheri','Madari','Madiga','Mahuria','Mala','Jhala','Malo',
            'Zala','Malha','Jhola','Mang','Mangan','Mehra','Mahar','Mehtar','Bhangi',
            'Mewar','Mundapotta','Musahar','Nagarchi','Namasudra','Paidi','Painda','Pamidi',
            'Pan','Pano','Buna Pana','Desua Pana','Panchama','Panika','Panka','Pantanti',
            'Pap','Pasi','Patial','Patikar','Patratanti','Potua','Rajna','Relli','Sabakhia',
            'Sualgiri','Swalgiri','Samasi','Sanei','Sapari','Sauntia','Santia','Sidhria',
            'Sinduria','Siyal','Khajuria','Tamadia','Tamudia','Tanla','Turi','Betra',
            'Ujia','Valamiki','Valmiki','Mangali','Mirgan'
        ];

        $now = Carbon::now();
        $data = [];

        foreach ($castes as $name) {
            $data[] = [
                'name' => $name,
                'is_active' => 1,
                'ref_id' => 1, // ✅ SC category
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => null,
                'deleted_by' => null,
                'delete_reason' => null,
            ];
        }

        // ✅ Chunk insert (safe & fast)
        foreach (array_chunk($data, 200) as $chunk) {
            DB::table('sub_castes')->insert($chunk);
        }
    }
}
