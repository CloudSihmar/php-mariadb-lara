<?php

namespace Database\Seeders;
use App\Models\LeaveBalance;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaveBalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $leavebalance1 = new LeaveBalance();
      $leavebalance1->user_id='1';
      $leavebalance1->casual_leave='10';
      $leavebalance1->earn_leave='10';
      $leavebalance1->remarks='';
      $leavebalance1->author='1';
      $leavebalance1->save();

      $leavebalance2 = new LeaveBalance();
      $leavebalance2->user_id='2';
      $leavebalance2->casual_leave='10';
      $leavebalance2->earn_leave='10';
      $leavebalance2->remarks='';
      $leavebalance2->author='1';
      $leavebalance2->save();
      
      $leavebalance3 = new LeaveBalance();
      $leavebalance3->user_id='3';
      $leavebalance3->casual_leave='10';
      $leavebalance3->earn_leave='10';
      $leavebalance3->remarks='';
      $leavebalance3->author='1';
      $leavebalance3->save();
    }
}
