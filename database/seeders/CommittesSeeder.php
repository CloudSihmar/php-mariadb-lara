<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Committee;

class CommittesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
  public function run()
  {
    $committees = [
      'Plenary',
      'House Committee',
      'Legislative',
      'Economic Affairs',
      'Social and Culture',
      'Good Governance',   
    ];

    foreach ($committees as $committee) {
      Committee::updateOrCreate(['name' => $committee]);
    }
  }
}
