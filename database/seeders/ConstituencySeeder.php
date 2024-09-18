<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Constituency;

class ConstituencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $constituencies = [
              'Chhoekhor Tang' => '1',
              'Chhumig Ura' => '1',
              'Bongo Chapchha' => '2',
              'Phuentshogling' => '2',
              'Drukjeygang Tseza' => '3',
              'Lhamoi Dzingkha Tashiding' => '3',
              'Khamaed Lunana' => '4',
              'Khatoed Laya' => '4',
              'Bji Kar Tshog Uesu' => '5',
              'Sombaykha' => '5',
              'Gangzur Minjey' => '6',
              'Maenbi Tsaenkhar' => '6',
              'Dramedtse Ngatshang' => '7',
              'Kengkhar Weringla' => '7',
              'Monggar' => '7',
              'Dokar Sharpa' => '8',
              'Lamgong Wangchang' => '8',
              'Khar Yurung' => '9',
              'Nanong Shumar' => '9',
              'Nganglam' => '9',
              'Kabisa Talog' => '10',
              'Lingmukha Toedwang' => '10',
              'Dewathang Gomdar' => '11',
              'Jomotshangkha Martshala' => '11',
              'Dophuchen Tading' => '12',
              'Phuentshogpelri Samtse' => '12',
              'Tashichhoeling' => '12',
              'Ugyentse Yoeseltse' => '12',
              'Gelegphu' => '13',
              'Shompangkha' => '13',
              'North Thimphu' => '14',
              'South Thimphu' => '14',
              'Bartsham Shongphu' => '15',
              'Kanglung Samkhar Udzorong' => '15',
              'Radhi Sakteng' => '15',
              'Thrimshing' => '15',
              'Wamrong' => '15',
              'Bomdeling Jamkhar' => '16',
              'Khamdang Ramjar' => '16',
              'Draagteng Langthil' => '17',
              'Nubi Tangsibji' => '17',
              'Kilkhorthang Mendrelgang' => '18',
              'Sergithang Tsirang Toed' => '18',
              'Athang Thedtsho' => '19',
              'Nyishog Saephu' => '19',
              'Athang Thedtsho' => '19',
              'Bardo Trong' => '20',
              'Panbang' => '20',
        ];
    
        foreach ($constituencies as $key => $value) {
          Constituency::updateOrCreate(
          ['name' => $key, 'dzongkhag_id' => $value, 'shortCode' => 'Desc', 'author' => 1],
        );
      }
    }
}
