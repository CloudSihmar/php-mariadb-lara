<?php

namespace Database\Seeders;

use App\Models\Admin\Iprange;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WhiteListIPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $iprange = new Iprange();
      $iprange->start_ip = '127.0.0.1';
      $iprange->end_ip = '127.0.0.7';
      $iprange->save();
    }
}
