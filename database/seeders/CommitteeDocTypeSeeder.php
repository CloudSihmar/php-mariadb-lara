<?php

namespace Database\Seeders;

use App\Models\Admin\Committeedoctype;
use App\Models\Admin\Iprange;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommitteeDocTypeSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $doctypes = [
      '1'=>'Minutes',
      '2'=>'Reports',
      '3'=>'Correspondings',
    ];

    foreach ($doctypes as $key => $value) {
      Committeedoctype::updateOrCreate(
        ['committee_id' => $key],
        ['name' => $value]
      );
    }
  }
}

