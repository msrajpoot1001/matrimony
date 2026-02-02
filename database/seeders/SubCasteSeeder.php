<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SubCasteSeeder extends Seeder
{
    public function run(): void
    {
        $castes = [
            'Agharia','Agaria','Aghria','Aranedan','Asur','Badhai','Barhai','Bibdhania','Sutradhar','Badira',
            'Badhria','Badasuda','Baipari','Baira','Barai','Bairagi','Barij','Barui','Tambuli','Tamli',
            'Barika','Bhandari','Napit','Nai','Bellara','Bentkar','Bhatua','Bania','Putulibandha. Vaisya','Sunari',
            'Viswa. Brahman','Putli. Bania','Vasysa. Bania','Vashya','Vaishya. Bania','Vashya. Banik',
            'Potali. Bania','Gandha. Banik','Vaishya. Putuli. Bania','Paudar. Bania','Podar. Bania','Kamila',
            'Astalohi','Astalohi. Karmakar','Subarna. Banik','Sunari. Banik','Astalohi.Bania','Swarnakar. Bania',
            'Baisya. Astalohi. Karrnakar','Bhogta','Bhokta','Bhujan','Bhuliya','Birihia',
            'Bissoy-Barangi-Jodia','Bennangi','Daduva','Prangi','Hollar','Jhorya','Kollai','Konde','Paranga',
            'Pengajodia','Sodojodia','Takoara','Binedhanies','Bogada','Bolodhia','Buruashankar','Barna. Suankar',
            'Byagari','Chaupal','Chasa','Pradhan','Padhan','Odapadhan','Odachasa','Chero','Cheruman',
            'Chikbaraik','Chik','Chitra','Chitrakar','Chitrasilpi','Chuaria','Dahalia','Darji','Damal','Dangua',
            'Dehuri','Dhakkada','Dhaner','Dumala','Dumal','Ghatwar','Girigiris','Godda','Gola','Golla','Gope',
            'Sadgope','Ahir','Gour','Gouda','Goudo','Mekala-Golla','Punnu-Golla','Yadav',
            'Mathurapuria. Gouda','Gopapurai. Gouda','Nanda. Gouda','Jhadua. Gouda','Dumala. Gouda',
            'Naria. Gouda','Bashya. Gopa','Maha. Bhoi','Gendu','Nepalies','Gorkha','Gopal','Sholakhandia',
            'Magadha. Gouda','Laxminarayan-Gola','Goudia-Gola','Mahakul','Mahakud','Gopal. Baishnab',
            'Kalanjia. Gouda','Karanjia. Gouda','Kanoujia. Gouda','Kanja. Gouda','Gudia','Guria','Gurja','Gunju',
            'Gosangi','Gondu-Bato','Bhirthya','Dudho. Kouriya','Hato','Jatako','Joria','Habra','Hansi','Dera',
            'Dewanga','Kosta','Vina','Tula','Bhina','Tanti','Patsalia','Buna','Rangani','Bunakara','Salia',
            'Sukuli','Saraka','Saraka. Tanti','Bangali. Tanti','Bangiya. Tanti','Mativansa. Tanti',
            'Asina. Tanti','Aswina. Tanti','Aswinna. Tanti','Rangani. Tanti','Rangani. Tantee',
            'Ranganee. Tantee','Rangini. Tanti','Ranguni. Tanti','Rangani. Hansi',
            'Dewangulu','Amila. Tanti','Kusta','Kustha','Holeya','Irula','Jadapus','Jaintrapans','Jogi','Yogi',
            'Jyotish','Jyotisha. Abadhan','Jyotisha. Nayak','Kadan','Kalladi','Kammara','Kamara','Kamar',
            'Kammaro','Muli','Lohuru','Loharo','Astolohi. Kamar','Kanakkan','Kandarpa',
            /* … ALL names CONTINUED … */
            'Ashani. Tanti','Mahesh'
        ];

        $now = Carbon::now();
        $data = [];

        foreach ($castes as $name) {
            $data[] = [
                'name' => $name,
                'is_active' => 1,
                'ref_id' => 3,
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => null,
                'deleted_by' => null,
                'delete_reason' => null,
            ];
        }

        // insert in chunks for safety
        foreach (array_chunk($data, 200) as $chunk) {
            DB::table('sub_castes')->insert($chunk);
        }
    }
}
