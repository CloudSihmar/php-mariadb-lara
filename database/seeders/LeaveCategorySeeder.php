<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Leavecategory;

class LeaveCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $leaveCategory = new Leavecategory();
        $leaveCategory->name = 'Maternity Leave';
        $leaveCategory->shortCode = 'Maternity Leave';
        $leaveCategory->leaveCode = 'ML';
        $leaveCategory->author = 1;
        $leaveCategory->save();

        $leaveCategory = new Leavecategory();
        $leaveCategory->name = 'Paternity Leave';
        $leaveCategory->shortCode = 'Paternity Leave';
        $leaveCategory->leaveCode = 'PL';
        $leaveCategory->author = 1;
        $leaveCategory->save();

        $leaveCategory = new Leavecategory();
        $leaveCategory->name = 'Casual Leave';
        $leaveCategory->shortCode = 'Casual Leave';
        $leaveCategory->leaveCode = 'CL';
        $leaveCategory->author = 1;
        $leaveCategory->save();

        $leaveCategory = new Leavecategory();
        $leaveCategory->name = 'Earned Leave';
        $leaveCategory->shortCode = 'Earned Leave';
        $leaveCategory->leaveCode = 'EA';
        $leaveCategory->author = 1;
        $leaveCategory->save();

        $leaveCategory = new Leavecategory();
        $leaveCategory->name = 'EoL';
        $leaveCategory->shortCode = 'EoL Leave';
        $leaveCategory->leaveCode = 'EO';
        $leaveCategory->author = 1;
        $leaveCategory->save();

        $leaveCategory = new Leavecategory();
        $leaveCategory->name = 'Medical Leave';
        $leaveCategory->shortCode = 'Medical Leave';
        $leaveCategory->leaveCode = 'MD';
        $leaveCategory->author = 1;
        $leaveCategory->save();

        $leaveCategory = new Leavecategory();
        $leaveCategory->name = 'Bereavement Leave';
        $leaveCategory->shortCode = 'Bereavement Leave';
        $leaveCategory->leaveCode = 'BL';
        $leaveCategory->author = 1;
        $leaveCategory->save();

        $leaveCategory = new Leavecategory();
        $leaveCategory->name = 'Study Leave';
        $leaveCategory->shortCode = 'Study Leave';
        $leaveCategory->leaveCode = 'SL';
        $leaveCategory->author = 1;
        $leaveCategory->save();

        $leaveCategory = new Leavecategory();
        $leaveCategory->name = 'Training';
        $leaveCategory->shortCode = 'Training';
        $leaveCategory->leaveCode = 'TR';
        $leaveCategory->author = 1;
        $leaveCategory->save();

        $leaveCategory = new Leavecategory();
        $leaveCategory->name = 'Tour';
        $leaveCategory->shortCode = 'Tour';
        $leaveCategory->leaveCode = 'TO';
        $leaveCategory->author = 1;
        $leaveCategory->save();

        $leaveCategory = new Leavecategory();
        $leaveCategory->name = 'Meeting';
        $leaveCategory->shortCode = 'Meeting';
        $leaveCategory->leaveCode = 'ME';
        $leaveCategory->author = 1;
        $leaveCategory->save();

        $leaveCategory = new Leavecategory();
        $leaveCategory->name = 'Seminar';
        $leaveCategory->shortCode = 'Seminar';
        $leaveCategory->leaveCode = 'SE';
        $leaveCategory->author = 1;
        $leaveCategory->save();

        $leaveCategory = new Leavecategory();
        $leaveCategory->name = 'Workshop';
        $leaveCategory->shortCode = 'Workshop';
        $leaveCategory->leaveCode = 'WO';
        $leaveCategory->author = 1;
        $leaveCategory->save();

        $leaveCategory = new Leavecategory();
        $leaveCategory->name = 'Deputation';
        $leaveCategory->shortCode = 'Deputation';
        $leaveCategory->leaveCode = 'DE';
        $leaveCategory->author = 1;
        $leaveCategory->save();

        $leaveCategory = new Leavecategory();
        $leaveCategory->name = 'Work From Home';
        $leaveCategory->shortCode = 'Work From Home';
        $leaveCategory->leaveCode = 'WH';
        $leaveCategory->author = 1;
        $leaveCategory->save();

        $leaveCategory = new Leavecategory();
        $leaveCategory->name = 'Covid Leave';
        $leaveCategory->shortCode = 'Covid Leave';
        $leaveCategory->leaveCode = 'CO';
        $leaveCategory->author = 1;
        $leaveCategory->save();

        $leaveCategory = new Leavecategory();
        $leaveCategory->name = 'Quoratine';
        $leaveCategory->shortCode = 'Quoratine';
        $leaveCategory->leaveCode = 'QR';
        $leaveCategory->author = 1;
        $leaveCategory->save();

    }
}
