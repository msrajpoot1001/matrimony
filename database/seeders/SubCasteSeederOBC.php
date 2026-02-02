<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SubCasteSeederOBC extends Seeder
{
    public function run(): void
    {
        $castes = [
            'Agharia','Agaria','Aghria','Aranedan','Asur','Badhai','Barhai','Bindhania','Sutradhar',
            'Badhira','Badhria','Badasuda','Baipari','Baira','Bairagi','Bariji','Barui','Tambuli',
            'Tamali','Barika','Bhandari','Napit','Bau','Bellara','Bentkar','Bhatua','Bhogta',
            'Bhokta','Bhujan','Bhuliya','Birjhia','Bissoy-Barangi Jodia','Bennangi','Daduva',
            'Farangi','Hollar','Jhoriya','Kollai','Konde','Paranga','Pengajodia','Sodojodia',
            'Takoara','Binedhanies','Bogada','Burushankar','Byagari','Chaupal','Chero',
            'Cheruman','Chikbaraik','Chik','Chitra','Chitrakar','Chitrasilpi','Churia',
            'Dahalia','Darji','Damal','Dangua','Dhuri','Dhakkada','Dhaner','Dumala','Dumal',
            'Ghatwar','Girigiris','Godda','Gola','Golla','Gope','Sadgope','Ahir','Gour',
            'Gouda','Goudo','Mekala-Golla','Punnu-Golla','Yadav','Gopal','Gopala',
            'Sholakhandia','Magadha Gouda','Laxminarayan-Gola','Goudia-Gola','Mathurapuria Gouda',
            'Gopapuria Gouda','Nanda Gouda','Kanja Gouda','Gudia','Gurja','Gunju','Gosangi',
            'Gondu-Bato','Bhirthya','Dudho Kouriya','Hato Jatako','Joria','Habra','Hansi','Dera',
            'Dewanga','Dewangulu','Kosta','Kusta','Kustha','Kostha','Vina','Tulabhina','Tanti',
            'Patsalia','Buna','Rangani','Bunkar','Bunkara','Salia','Sukuli','Bangali Tanti',
            'Bangiya Tanti','Mativansa Tanti','Asina Tanti','Barna Suankar','Sadgop','Gop',
            'Aswina Tanti','Ashani Tanti','Aswinnna Tanti','Rangani Tanti','Ranganee Tantee',
            'Rangini Tanti','Ranguni Tanti','Amila Tanti','Holeya','Irula','Jadapus',
            'Jaintrapans','Jogi','Jyotish','Kadan','Kalladi','Kammara','Kamara','Kamar',
            'Kammaro','Muli','Lohuru','Loharo','Astolohi Kamar','Kanakkan','Kandarpa','Kanjar',
            'Kapudia','Karhara','Kachara','Kachera','Karmali','Khaira','Khatti-Khatti','Khatua',
            'Khodra','Kharuda','Koilar','Kolam','Konda Kapu','Kondareddy','Koraga','Kosalya',
            'Goudus','Dangayath','Doddu','Kamariya','Kota','Kudubi','Kusumban','Kumbhar',
            'Kulal','Kumhar','Kumbharo','Kandha-Kumbhar','Kumbhakar','Kundamatia','Kulta',
            'Kuravan','Kuruman','Lambadi','Luhura','Machua','Maghi','Magura','Mahunta',
            'Maila','Maladasu','Malasar','Mali','Phulia','Sagbaria','Bhajemali','Muni','Raula',
            'Marathi','Matangi','Moger','Mudhadora','Muliya','Mundala','Muria','Nahar','Nat',
            'Nolia','Ojulu','Padaria','Pamaria','Pandara','Pal','Paiko','Palli','Pulayan',
            'Paniyan','Paraiyan','Paravan','Pathuria','Pengua','Routia','Sankhari','Sanyasi',
            'Sauria Paharia','Sundi','Sundhi','Teli','Telli','Kubara','Talakar','Sahu','Sahoo',
            'Telaga','Pamula','Telugu','Telanga','Thatari','Kansari','Thoti','Toda','Vannan',
            'Vettuvan','Yerna Golta','Yerukula','Saraka','Saraka Tanti','Chasa','Odachasa',
            'Banayat','Patra','Patara','Kurmi','Kuruma Chasa','Kudumi','Kurmi Mahto',
            'Kurumi','Thoria','Thudia','Kalingi','Kamila','Sunari','Viswa Brahman',
            'Swarnakar','Kalwar','Kalal','Kalar','Hatua','Shudra','Tamuli','Tambili',
            'Tambula','Goudia','Segidi','Bhopa','Pandara Mali'
        ];

        $now = Carbon::now();
        $data = [];

        foreach ($castes as $name) {
            $data[] = [
                'name' => $name,
                'is_active' => 1,
                'ref_id' => 5, // ✅ OBC category
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => null,
                'deleted_by' => null,
                'delete_reason' => null,
            ];
        }

        // 🚀 Chunk insert for safety
        foreach (array_chunk($data, 200) as $chunk) {
            DB::table('sub_castes')->insert($chunk);
        }
    }
}
