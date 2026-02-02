<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SubCasteSeederST extends Seeder
{
    public function run(): void
    {
        $castes = [
            'Bagata','Bhakta','Baiga','Banjara','Banjari','Bathudi','Bathuri',
            'Bhottada','Dhotada','Bhotra','Bhatra','Bhattara','Bhotora','Bhatara',
            'Bhuiya','Bhuyan','Bhumia','Bhumij','Teli Bhumij','Haladipokhria Bhumij',
            'Haladipokharia Bhumij','Desi Bhumij','Desia Bhumij','Tamaria Bhumij',
            'Bhunjia','Binjhal','Binjhwar','Binjhia','Binjhoa','Birhor',
            'Bondo Poraja','Bonda Paroja','Banda Paroja','Chenchu','Dal',
            'Desua Bhumij','Dharua','Dhuruba','Dhuruva','Didyi','Didai Paroja',
            'Didai','Gadaba','Bodo Gadaba','Gutob Gadaba','Kapu Gadaba',
            'Ollara Gadaba','Sano Gadaba','Gandia','Ghara','Gond','Gondo',
            'Rajgond','Maria Gond','Dhur Gond','Ho','Holva','Jatapu','Juang',
            'Kandha Gauda','Kawar','Kanwar','Kharia','Kharian','Berga Kharia',
            'Dhelki Kharia','Dudh Kharia','Erenga Kharia','Munda Kharia',
            'Oraon Kharia','Khandia','Pahari Kharia','Kharwar','Khond','Kond',
            'Kandha','Nanguli Kandha','Sitha Kandha','Kondh','Kui','Buda Kondh',
            'Bura Kandha','Desia Kandha','Dungaria Kondh','Kutia Kandha',
            'Muli Kondh','Malua Kondh','Pengo Kandha','Raja Kondh','Raj Kondh',
            'Kisan','Nagesar','Nagesia','Kol','Kolah Loharas','Kol Loharas',
            'Koli','Malhar','Kondadora','Kora','Khaira','Khayara','Korua',
            'Kotia','Koya','Gumba Koya','Koitur Koya','Kamar Koya','Musara Koya',
            'Kulis','Lodha','Nodha','Lodh','Madia','Mahali','Mankidi',
            'Mandirdia','Mandria','Matya','Matia','Mirdhas','Kuda','Koda',
            'Munda','Munda Lohara','Munda Mahalis','Nagabanshi Munda',
            'Oriya Munda','Mundari','Amanatya','Oraon','Dhangar','Uran',
            'Parenga','Paroja','Parja','Bodo Jhodia Paroja','Chhelia Paroja',
            'Jhodia Paroja','Konda Paroja','Paraja','Ponga Paroja',
            'Sodia Paroja','Sano Paroja','Solia Paroja','Pentia','Rajuar',
            'Santal','Saora','Savar','Saura','Sahara','Arsi Saora',
            'Baded Saora','Bhima Saora','Bhimma Saora','Chumura Saora',
            'Jara Savar','Jadu Saora','Jati Saora','Juari Saora','Kampu Saora',
            'Kapo Saora','Kindal Saora','Kumbi Kancher Saora',
            'Kalapithia Saora','Kirat Saora','Lanjia Saora',
            'Lamba Lanjia Saora','Luara Saora','Luar Saora','Laria Savar',
            'Malia Saora','Malla Saora','Uriay Saora','Raika Saora',
            'Sudda Saora','Sarda Saora','Tankal Saora','Patro Saora',
            'Vesu Saora','Shabar','Sounti','Tharua','Tharua Bindhani'
        ];

        $now = Carbon::now();
        $data = [];

        foreach ($castes as $name) {
            $data[] = [
                'name' => $name,
                'is_active' => 1,
                'ref_id' => 4, // ✅ ST category
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => null,
                'deleted_by' => null,
                'delete_reason' => null,
            ];
        }

        // 🚀 Fast & safe bulk insert
        foreach (array_chunk($data, 200) as $chunk) {
            DB::table('sub_castes')->insert($chunk);
        }
    }
}
