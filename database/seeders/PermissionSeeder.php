<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
      $permissions = [
      'Attendance'   => 'attendance',
      'Attendance Report' => 'attendance.report',

      'Leave'   => 'leave',
      'Leave Report' => 'leave.report',
      'Manage Holidays'   => 'manage.holiday',
      'Manage Leave Balance' => 'manage.leave.balance',

      'Manage Letter'   => 'manage.letter',
      'Dispatched Report' => 'dispatched.report',
      'Received Report'   => 'received.report',

      'Workflows'   => 'workflow',
      'Workflow Report'   => 'workflow.report',

      'Conference hall booking'   => 'conference.hall.booking',
      'Conference hall booking Report' => 'conference.hall.booking.report',

      'Session Document'   => 'session.documents',
      'Session Document Upload' => 'session.document.upload',
      'Session Document Delete' => 'session.document.delete',

      'Committee Document'   => 'committee.documents',
      'Committee Document Upload' => 'committee.document.upload',
      'Committee Document Delete' => 'committee.document.delete',


      'Secretariat Document'   => 'secretariat.documents',
      'Secretariat Document Upload' => 'secretariat.document.upload',
      'Secretariat Document Delete' => 'secretariat.document.delete',

      'Joint Sitting Document'   => 'joint.sitting.documents',
      'Joint Sitting Document Upload' => 'joint.sitting.document.upload',
      'Joint Sitting Document Delete' => 'joint.sitting.document.delete',

      'View Archive'   => 'archive.view',
      'Session Document Archive'   => 'session.document.archives',
      'Session Document Delete' => 'session.document.delete',

      'Committee Document Archive'   => 'committee.document.archives',
      'Committee Document Delete' => 'committee.document.delete',

      'Secretariat Document Archive'   => 'secretariat.document.archives',
      'Secretariat Document Delete' => 'secretariat.document.delete',

      'Joint Sitting Document Archive'   => 'joint.sitting.document.archives',
      'Joint Sitting Document Delete' => 'joint.sitting.document.delete',

     

      ];

      foreach ($permissions as $key => $value) {
        Permission::updateOrCreate(
          ['name' => $key],
          ['slug' => $value]
        );
      }
    }
}
