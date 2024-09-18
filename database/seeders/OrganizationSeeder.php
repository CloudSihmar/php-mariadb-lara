<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Agency;
use App\Models\Admin\Department;
use App\Models\Admin\Division;


class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $agency = new Agency();
        $agency->name = 'NAB';
        $agency->shortCode = 'NAB of Bhutan';
        $agency->author = 1;
        $agency->save();

        $dept1 = new Department();
        $dept1->name = 'Secretriat';
        $dept1->agency_id = 1;
        $dept1->shortCode = 'Secretriat of NAB';
        $dept1->author = 1;
        $dept1->save();

        $dept2 = new Department();
        $dept2->name = 'Parliament';
        $dept2->agency_id = 1;
        $dept2->shortCode = 'Parliament Member';
        $dept2->author = 1;
        $dept2->save();


        $division1 = new Division();
        $division1->name = 'ICT';
        $division1->department_id = 1;
        $division1->shortCode = 'ICT Division';
        $division1->author = 1;
        $division1->save();

        $division2 = new Division();
        $division2->name = 'Secretariat Service Division';
        $division2->department_id = 1;
        $division2->shortCode = 'Secretariat Service Division';
        $division2->author = 1;
        $division2->save();

        $division2 = new Division();
        $division2->name = 'Legislative and Procedural Division';
        $division2->department_id = 1;
        $division2->shortCode = 'Legislative and Procedural Division';
        $division2->author = 1;
        $division2->save();

        $division3 = new Division();
        $division3->name = 'Hansard and Research Division';
        $division3->department_id = 1;
        $division3->shortCode = 'Hansard and Research Division';
        $division3->author = 1;
        $division3->save();

        $division3 = new Division();
        $division3->name = 'Member of Parliament';
        $division3->department_id = 2;
        $division3->shortCode = 'Parliament Member';
        $division3->author = 1;
        $division3->save();

        $division3 = new Division();
        $division3->name = 'National Council';
        $division3->department_id = 2;
        $division3->shortCode = 'National Council Member';
        $division3->author = 2;
        $division3->save();
        
    }
}
