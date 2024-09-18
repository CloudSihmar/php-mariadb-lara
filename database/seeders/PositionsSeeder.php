<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PositionLevel;
use App\Models\PositionTitle;

class PositionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positionlevel = new PositionTitle();
        $positionlevel->name = 'General Secretary';
        $positionlevel->shortCode = 'Secretary';
        $positionlevel->author = 1;
        $positionlevel->save();

        $positionlevel = new PositionTitle();
        $positionlevel->name = 'Driver III';
        $positionlevel->shortCode = 'Driver III';
        $positionlevel->author = 1;
        $positionlevel->save();

        $positionlevel = new PositionTitle();
        $positionlevel->name = 'Adm. Assistant';
        $positionlevel->shortCode = 'Adm. Assistant';
        $positionlevel->author = 1;
        $positionlevel->save();

        $grade = new PositionLevel();
        $grade->name = 'EX1';
        $grade->shortCode = 'Executive';
        $grade->author = 1;
        $grade->save();

        $grade = new PositionLevel();
        $grade->name = 'P1';
        $grade->shortCode = 'Management Group';
        $grade->author = 1;
        $grade->save();

        $grade = new PositionLevel();
        $grade->name = 'O1';
        $grade->shortCode = 'Operation Group';
        $grade->author = 1;
        $grade->save();

    }
}
