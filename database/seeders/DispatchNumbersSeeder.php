<?php

namespace Database\Seeders;
use App\Models\LeaveBalance;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DispatchReceiveNumber;

class DispatchNumbersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $dispatch_numbers = new DispatchReceiveNumber();
      $dispatch_numbers->dORr=1;
      $dispatch_numbers->dr_num=1;
      $dispatch_numbers->year='2022';
      $dispatch_numbers->author=1;
      $dispatch_numbers->save();

      $dispatch_numbers = new DispatchReceiveNumber();
      $dispatch_numbers->dORr=2;
      $dispatch_numbers->dr_num=1;
      $dispatch_numbers->year='2022';
      $dispatch_numbers->author=1;
      $dispatch_numbers->save();

      $dispatch_numbers = new DispatchReceiveNumber();
      $dispatch_numbers->dORr=1;
      $dispatch_numbers->dr_num=1;
      $dispatch_numbers->year='2023';
      $dispatch_numbers->author=1;
      $dispatch_numbers->save();

      $dispatch_numbers = new DispatchReceiveNumber();
      $dispatch_numbers->dORr=2;
      $dispatch_numbers->dr_num=2;
      $dispatch_numbers->year='2023';
      $dispatch_numbers->author=1;
      $dispatch_numbers->save();
    }
}
