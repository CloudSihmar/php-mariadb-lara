<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Parliament;
use App\Models\Admin\Parliamentsession;


class ParliamentSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    //
        $parliament = new Parliament();
        $parliament->name = '1<sup>st</sup> Parliament';
        $parliament->shortCode = '1<sup>st</sup> Parliament';
        $parliament->save();

        $parliament = new Parliament();
        $parliament->name = '2<sup>nd</sup> Parliament';
        $parliament->shortCode = '2<sup>nd</sup> Parliament';
        $parliament->save();

        $parliament = new Parliament();
        $parliament->name = '3<sup>rd</sup> Parliament';
        $parliament->shortCode = '3<sup>rd</sup> Parliament';
        $parliament->save();

        $session = new Parliamentsession();
        $session->name = 'Session 1';
        $session->parliament_id = 1;
        $session->shortCode = 'Session 1';
        $session->save();

        $session = new Parliamentsession();
        $session->name = 'Session 2';
        $session->parliament_id = 1;
        $session->shortCode = 'Session 2';
        $session->save();

        $session = new Parliamentsession();
        $session->name = 'Session 1';
        $session->parliament_id = 2;
        $session->shortCode = 'Session 1';
        $session->save();

        $session = new Parliamentsession();
        $session->name = 'Session 2';
        $session->parliament_id = 2;
        $session->shortCode = 'Session 2';
        $session->save();


        $session = new Parliamentsession();
        $session->name = 'Session 1';
        $session->parliament_id = 3;
        $session->shortCode = 'Session 1';
        $session->save();

        $session = new Parliamentsession();
        $session->name = 'Session 2';
        $session->parliament_id = 3;
        $session->shortCode = 'Session 2';
        $session->save();
    }
}
