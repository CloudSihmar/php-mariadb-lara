<?php

namespace Database\Seeders;
use App\Models\Admin\LeaveStatus;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaveStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $leavestatus = new LeaveStatus();
        $leavestatus->name = 'Approved';
        $leavestatus->shortCode = 'Approved';
        $leavestatus->save();

        $leavestatus = new LeaveStatus();
        $leavestatus->name = 'Rejected';
        $leavestatus->shortCode = 'Rejected';
        $leavestatus->save();

        $leavestatus = new LeaveStatus();
        $leavestatus->name = 'Pending';
        $leavestatus->shortCode = 'Pending';
        $leavestatus->save();


    }
}
