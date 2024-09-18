<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(LeaveStatusSeeder::class);
        $this->call(LeaveCategorySeeder::class);
        $this->call(LeaveBalanceSeeder::class);
        $this->call(OrganizationSeeder::class);
        $this->call(DispatchNumbersSeeder::class); 
        $this->call(PositionsSeeder::class);
        $this->call(ParliamentSessionSeeder::class);
        $this->call(CommittesSeeder::class);
        $this->call(SessionDocCategorySeeder::class);
        $this->call(ConferanceHallSeeder::class);
        $this->call(HolidaySeeder::class);
        $this->call(ConstituencySeeder::class);
        $this->call(DzongkhagSeeder::class);
        $this->call(WhiteListIPSeeder::class);
        $this->call(CommitteeDocTypeSeeder::class);
        $this->call(AttendanceStatusSeeder::class);
    }
}
