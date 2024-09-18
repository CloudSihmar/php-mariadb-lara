<?php

namespace Database\Seeders;
use App\Models\Role;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $manager = new Role();
      $manager->name = 'admin';
      $manager->slug = 'admin';
      $manager->save();

      $member = new Role();
      $member->name = 'member';
      $member->slug = 'member';
      $member->save();

      $member = new Role();
      $member->name = 'secretariat';
      $member->slug = 'secretariat';
      $member->save();
    }
}
