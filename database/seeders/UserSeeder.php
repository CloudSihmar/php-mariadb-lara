<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $admin = Role::where('slug', 'admin')->first();
      $secretariat = Role::where('slug', 'secretariat')->first();
      $member = Role::where('slug', 'member')->first();
      $createTasks = Permission::where('slug', 'create')->first();
      $manageUsers = Permission::where('slug', 'manage-users')->first();

      $user1 = new User();
      $user1->name = 'Admin';
      $user1->email = 'admin@prms.gov.bt';
      $user1->username = 'admin';
      $user1->password = bcrypt('password');
      $user1->agency_id = 1;
      $user1->department_id = 1;
      $user1->division_id = 1;
      $user1->status = 1;
      $user1->contactno = 17170000;
      $user1->empid = 20041232;
      $user1->cid = 101231233213;
      $user1->positiontitle = 1;
      $user1->positionlevel = 1;
      $user1->gender = 1;
      $user1->save();
      $user1->roles()->attach($admin);
      $user1->permissions()->attach($createTasks);

      $user2 = new User();
      $user2->name = 'secretariat';
      $user2->email = 'secretariat@prms.gov.bt';
      $user2->username = 'secretariat';
      $user2->password = bcrypt('password');
      $user2->agency_id = 1;
      $user2->department_id = 1;
      $user2->division_id = 2;
      $user2->status = 1;
      $user2->contactno = 17172200;
      $user2->empid = 20041232;
      $user2->cid = 101231233213;
      $user2->positiontitle = 1;
      $user2->positionlevel = 1;
      $user2->gender = 1;
      $user2->save();
      $user2->roles()->attach($secretariat);
      $user2->permissions()->attach($manageUsers);


      $user3 = new User();
      $user3->name = 'Member 1';
      $user3->email = 'member1@prms.gov.bt';
      $user3->username = 'mp';
      $user3->password = bcrypt('password');
      $user3->agency_id = 1;
      $user3->department_id = 2;
      $user3->division_id = 5;
      $user3->status = 1;
      $user3->contactno = 17174400;
      $user3->empid = 20041232;
      $user3->cid = 101231233213;
      $user3->positiontitle = 1;
      $user3->positionlevel = 1;
      $user3->gender = 1;
      $user3->constituency_id = 1;
      $user3->save();
      $user3->roles()->attach($member);
      $user3->permissions()->attach($manageUsers);
      
      $user3 = new User();
      $user3->name = 'Member 2';
      $user3->email = 'member2@prms.gov.bt';
      $user3->username = 'nc';
      $user3->password = bcrypt('password');
      $user3->agency_id = 1;
      $user3->department_id = 2;
      $user3->division_id = 6;
      $user3->status = 1;
      $user3->contactno = 17174400;
      $user3->empid = 20041232;
      $user3->cid = 101231233213;
      $user3->positiontitle = 1;
      $user3->positionlevel = 1;
      $user3->gender = 1;
      $user3->dzongkhag_id = 1;
      $user3->save();
      $user3->roles()->attach($member);
      $user3->permissions()->attach($manageUsers);

    }
}
