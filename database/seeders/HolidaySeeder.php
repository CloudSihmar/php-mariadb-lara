<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Holiday;

class HolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $holiday = new Holiday();
        $holiday->holiday_date='2023-01-02';
        $holiday->shortCode='Desc';
        $holiday->year='2023';
        $holiday->author=1;
        $holiday->save();

        $holiday = new Holiday();
        $holiday->holiday_date='2023-02-21';
        $holiday->shortCode='Desc';
        $holiday->year='2023';
        $holiday->author=1;
        $holiday->save();

        $holiday = new Holiday();
        $holiday->holiday_date='2023-02-22';
        $holiday->shortCode='Desc';
        $holiday->year='2023';
        $holiday->author=1;
        $holiday->save();

        $holiday = new Holiday();
        $holiday->holiday_date='2023-02-23';
        $holiday->shortCode='Desc';
        $holiday->year='2023';
        $holiday->author=1;
        $holiday->save();


        $holiday = new Holiday();
        $holiday->holiday_date='2023-05-02';
        $holiday->shortCode='Desc';
        $holiday->year='2023';
        $holiday->author=1;
        $holiday->save();

        $holiday = new Holiday();
        $holiday->holiday_date='2023-06-28';
        $holiday->shortCode='Desc';
        $holiday->year='2023';
        $holiday->author=1;
        $holiday->save();

        $holiday = new Holiday();
        $holiday->holiday_date='2023-07-21';
        $holiday->shortCode='Desc';
        $holiday->year='2023';
        $holiday->author=1;
        $holiday->save();

        $holiday = new Holiday();
        $holiday->holiday_date='2023-09-20';
        $holiday->shortCode='Desc';
        $holiday->year='2023';
        $holiday->author=1;
        $holiday->save();

        $holiday = new Holiday();
        $holiday->holiday_date='2023-09-25';
        $holiday->shortCode='Desc';
        $holiday->year='2023';
        $holiday->author=1;
        $holiday->save();

        $holiday = new Holiday();
        $holiday->holiday_date='2023-09-26';
        $holiday->shortCode='Desc';
        $holiday->year='2023';
        $holiday->author=1;
        $holiday->save();

        $holiday = new Holiday();
        $holiday->holiday_date='2023-10-24';
        $holiday->shortCode='Desc';
        $holiday->year='2023';
        $holiday->author=1;
        $holiday->save();

        $holiday = new Holiday();
        $holiday->holiday_date='2023-11-01';
        $holiday->shortCode='Desc';
        $holiday->year='2023';
        $holiday->author=1;
        $holiday->save();
    }
}
