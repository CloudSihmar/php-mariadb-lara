<?php

namespace Database\Seeders;

use App\Models\Admin\Dzongkhag;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DzongkhagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        $dzongkhags = [
            'Bumthang',
            'Chukha',
            'Dagana',
            'Gasa',
            'Haa',
            'Lhuentse',
            'Mongar',
            'Paro',
            'Pemagatshel',
            'Punakha',
            'Samdrup Jongkhar',
            'Samtse',
            'Sarpang',
            'Thimphu',
            'Trashigang',
            'Trashiyangtse',
            'Trongsa',
            'Tsirang',
            'Wangdue Phodrang',
            'Zhemgang'
          ];
      
          foreach ($dzongkhags as $dzongkhag) {
            Dzongkhag::updateOrCreate(
                ['name' => $dzongkhag,'shortCode' => 'Desc', 'author'=>1]
            );
          }
    }
}
