<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\AttendanceStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AttendanceStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
  public function run()
  {
    $status = [
      'In Office',
      'Meeting',
      'Holiday',
      'Tour',
      'Seminer',
    ];

    foreach ($status as $stat) {
      AttendanceStatus::updateOrCreate(
        ['name' => $stat,'shortCode' => 'Desc', 'author'=>1]
      );
    }
  }
}
