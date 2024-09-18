<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Conferencehall;

class ConferanceHallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $conferancehall = new Conferencehall();
        $conferancehall->name= 'Conference hall A';
        $conferancehall->save();

        $conferancehall = new Conferencehall();
        $conferancehall->name= 'Conference hall B';
        $conferancehall->save();
    }
}
