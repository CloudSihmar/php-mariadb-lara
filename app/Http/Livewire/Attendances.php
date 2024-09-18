<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Leave;
use Livewire\Component;
use Carbon\CarbonPeriod;
use App\Models\Attendance;
use App\Models\Admin\Division;
use Illuminate\Support\Facades\Auth;
use App\Models\SupervisorUpdatedLogs;
use App\Models\Admin\AttendanceStatus;
use Illuminate\Support\Facades\Session;
use PDF;

class Attendances extends Component
{
    public $attendance;
    public $leavescategories;
    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;
    public $approve = false;
    public $resultCount;
    public $checkoutFormModal = false;
    public $attendanceId;
    public $attendanceStatus;
    public $LEAVE_APPROVED = 1;
    public $leaveButton = 0;
    public $divisions;
    public $division_id;
    public $employeeName;
    public $attendances;

    public $totalleavePending;
    public $totalLateAttendance;
    public $totalstaffLeave;
    public $totalnotusedAttendance;
    public $leavecategories;
    public $attendancereports;
    public $leaves;

    public $fromDate;
    public $toDate;
    public $supervisor;

    // public $SECRETARIAT_DEPT = 4;
    public $MEMBER_DEPT = 2;
    public $userstatus_id;
    public $attendancestatusList;

    public $divisionOrConsituency;

    public $totalmember_present;
    public $totalmember_absent;
    public $totalmembers;

    protected $rules = [
        'attendance.inNotes' => 'nullable',
    ];


    public function mount()
    {
        $this->leavecategories = collect();
        $this->attendancereports = collect();
        $this->leaves = collect();
        $this->attendances = collect();
        $this->divisions = Division::where('department_id',Auth::user()->department_id)->get();
        $this->attendancestatusList = AttendanceStatus::all();
        // $this->divisionOrConsituency= 'Division';

        $this->totalmember_absent = 0;
        $this->totalmember_present = 0;
        $this->totalmembers= 0;;

        $userSupervisorName = User::where('id', Auth::user()->id)->get()->first();
        $this->supervisor = User::find($userSupervisorName->headId);
        
         //Offgt Supervisor Role
        $today = Date('Y-m-d');
        $offgtSupervisorDtl = SupervisorUpdatedLogs::where('old_headId', $userSupervisorName->headId)->where('fromdate','<=',$today)->where('todate','>=',$today)->get();
      
        if (count($offgtSupervisorDtl) > 0) {
            if($offgtSupervisorDtl->first()->new_headId == Auth::user()->id)
            {
                $this->supervisor = User::find($offgtSupervisorDtl->first()->old_headId);
            }else{
                $this->supervisor = User::find($offgtSupervisorDtl->first()->new_headId);
            }
        } 
        // else {
        //     $userSupervisorName = User::where('id', Auth::user()->id)->get()->first();
        //     $this->supervisor = User::find($userSupervisorName->headId);
        // }
        $this->getDivisionName();
        $this->user_division = Auth::user()->division_id;
        if (in_array($this->user_division,[5,6])){ //Member
            $this->memberSummaryReport();
        } else {
            $this->secretariatSummaryReport();
        }
       
        $this->attendances = User::with('userstatus')->where('status', 1)->where('division_id', Auth::user()->division_id)->orderBy('display_order', 'asc')->get();
    }

    /**
     * member Summary dashboard report
     *
     * @return void
     */
    public function memberSummaryReport()
    {
        $today = Date('Y-m-d');
        $perPage = 100;

        $this->totalleavePending = 0;
        $this->totalLateAttendance = 0;
        $this->totalstaffLeave = 0;
        $this->totalnotusedAttendance = 0;
        $totalLeave = 0;

        $result = Leave::where('status', '3')->where('department_id', $this->MEMBER_DEPT)->get();
        $this->totalleavePending = $result->count();

        $result = Attendance::where('department_id', $this->MEMBER_DEPT)->where('inStatus', 'Late')->where('created_at', 'like', '%' . $today . '%')->get();
        $this->totalLateAttendance = $result->count();

        $leaveRecord = Leave::where('department_id', $this->MEMBER_DEPT)->where('toDate', '>=', $today)->where('status', 1)->get();
        $this->totalstaffLeave = count($leaveRecord);

        $totalusers = User::where('status', '1')->where('department_id', Auth::user()->department_id)->get()->count();
        $attendedresult = Attendance::where('department_id', Auth::user()->department_id)->where('created_at', 'like', '%' . $today . '%')->get()->count();
        $this->totalnotusedAttendance = $totalusers - $attendedresult;

        $leave_arr = array();
        $checkLeave = Leave::where('author', Auth::user()->id)->where('status', $this->LEAVE_APPROVED)->orderBy('created_at', 'desc')->take(1)->get();//first();
        if (count($checkLeave) > 0) {
            $from = $checkLeave[0]->fromDate;
            $to = $checkLeave[0]->toDate;

            $dateRange = CarbonPeriod::create($from, $to);
            foreach ($dateRange as $date) {
                array_push($leave_arr, $date->format('Y-m-d'));
            }
            if (in_array($today, $leave_arr)) {
                $this->leaveButton = true;
            }
        }

        $resultQry = Attendance::where('author', Auth::user()->id)->where('created_at', 'like', '%' . $today . '%')->get();

        $this->resultCount = $resultQry->count();

        if ($this->resultCount > 0) {
            $this->attendanceId = $resultQry[0]->id;
            $this->attendanceStatus = $resultQry[0]->status;
        }
    }

    /**
     * Secretariat Summary dashboard report
     *
     * @return void
     */
    public function secretariatSummaryReport()
    {
        $today = Date('Y-m-d');
        $perPage = 30;

        $this->totalleavePending = 0;
        $this->totalLateAttendance = 0;
        $this->totalstaffLeave = 0;
        $this->totalnotusedAttendance = 0;
        $totalLeave = 0;
//dd( Auth::user()->department_id);
        $result = Leave::where('status', '3')->where('department_id', Auth::user()->department_id)->get();
        $this->totalleavePending = $result->count();

        $result = Attendance::where('department_id', Auth::user()->department_id)->where('inStatus', 'Late')->where('created_at', 'like', '%' . $today . '%')->get();
        $this->totalLateAttendance = $result->count();

        $leaveRecord = Leave::where('department_id', Auth::user()->department_id)->where('toDate', '>=', $today)->where('status', 1)->get();
        // for ($i = 0; $i < count($leaveRecord); $i++) {
        //     if ($leaveRecord[$i]->fromDate >= $today) {
        //         $totalLeave += 1;
        //     }
        // }
        $this->totalstaffLeave = count($leaveRecord);//$totalLeave;

        $totalusers = User::where('status', '1')->where('department_id', Auth::user()->department_id)->get()->count();
        $attendedresult = Attendance::where('department_id', Auth::user()->department_id)->where('created_at', 'like', '%' . $today . '%')->get()->count();
        $this->totalnotusedAttendance = $totalusers - $attendedresult;

        $leave_arr = array();
        $checkLeave = Leave::where('author', Auth::user()->id)->where('status', $this->LEAVE_APPROVED)->orderBy('created_at', 'desc')->take(1)->get();//first();
        if (count($checkLeave) > 0) {
            $from = $checkLeave[0]->fromDate;
            $to = $checkLeave[0]->toDate;

            $dateRange = CarbonPeriod::create($from, $to);
            foreach ($dateRange as $date) {
                array_push($leave_arr, $date->format('Y-m-d'));
            }
            if (in_array($today, $leave_arr)) {
                $this->leaveButton = true;
            }
        }

        $resultQry = Attendance::where('author', Auth::user()->id)->where('created_at', 'like', '%' . $today . '%')->get();

        $this->resultCount = $resultQry->count();

        if ($this->resultCount > 0) {
            $this->attendanceId = $resultQry[0]->id;
            $this->attendanceStatus = $resultQry[0]->status;
        }
    }

    public function render()
    {
      
        return view('livewire.attendances.index')->layout(getLayout());
    }

    /**
     * store  data
     *
     * @return void
     */

    public function checkIn()
    {

        //dd($_SERVER['REMOTE_ADDR']);
        if (isset($this->attendance->id)) {
            $this->attendance->save();
            session()->flash('message', 'Attendance successfully updated!');
        } else {
            $startTime = '09:00:00';
            $endTime = '17:00:00';

            $currentDateTime = Carbon::now();
            $newDateTime = Carbon::now()->addHour(6);
            $currentTime = strtotime($newDateTime);

            $currentDay = date("D");

            if (empty($this->attendance['inNotes'])) {
                $remarknotes = '';
            } else {
                $remarknotes = $this->attendance['inNotes'];
            }

            if (str_contains($currentDay, "Sat1") || str_contains($currentDay, "Sun1")) {
                session()->flash('error', 'Attendance cannot be done on weekend!');
            } else {
                if (Date('H:i:s', $currentTime) <= $startTime) {
                    $inStatus = 'On Time';
                } else {
                    $inStatus = 'Late';
                }
                $data = array(
                    'inNotes' => $remarknotes,
                    'status' => 1,
                    'ip_address' => $_SERVER['REMOTE_ADDR'],
                    'author' => Auth::user()->id,
                    'checkIn' => $currentTime,
                    'inStatus' => $inStatus,
                    'department_id' => Auth::user()->department_id,
                    'division_id' => Auth::user()->division_id,
                );

                //Utilities::insertAttendanceLeaveRecord(Auth::user()->id, $newDateTime, 0);

                Attendance::create($data);
                
                $userDtl = User::find(Auth::user()->id);
                $userDtl->userstatus_id = 1;
                $userDtl->save();
                session()->flash('message', 'Attendance CheckIn successfully!');
            }
        }
        $this->reset(['attendance']);
        $this->confirmItemAdd = false;
        return redirect()->route('app.attendance.applications');
    }


    public function checkoutForm()
    {
        $this->checkoutFormModal = true;
        $this->validate();
        $startTime = '09:00:00';
        $endTime = '17:00:00';
        $currentDateTime = Carbon::now();
        $newDateTime = Carbon::now()->addHour(6);
        $currentTime = strtotime($newDateTime);

        $currentDay = Date("D");
        if (str_contains($currentDay, "Sat1") || str_contains($currentDay, "Sun1")) {
            session()->flash('error', 'Attendance cannot be done on weekend!');
        } else {
            if (date('H:i:s', $currentTime) >= $endTime) {
                $outStatus = 'Over Time';
            } else {
                $outStatus = 'Early';
            }
            if (empty($this->attendance['inNotes'])) {
                $remarknotes = '';
            } else {
                $remarknotes = $this->attendance['inNotes'];
            }

            $attendance = Attendance::find($this->attendanceId);
            $attendance->outNotes = $remarknotes;
            $attendance->status = 0;
            $attendance->ip_address = $_SERVER['REMOTE_ADDR'];
            $attendance->checkOut = $currentTime;
            $attendance->author = Auth::user()->id;
            $attendance->outStatus = $outStatus;
            $attendance->save();
            session()->flash('message', 'Attendance CheckOut Successfully!');
        }
        $userDtl = User::find(Auth::user()->id);
        $userDtl->userstatus_id = null;
        $userDtl->save();

        $this->reset(['attendance']);
        $this->confirmItemAdd = false;
        $this->checkoutFormModal = false;
        return redirect()->route('app.attendance.applications');
    }

    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(Attendance $attendance)
    {
        $this->attendance = $attendance;
        $this->confirmItemAdd = true;
        $this->checkoutFormModal = false;
    }

    /**
     * Display confim deletion modal.
     */

    public function showDeleteModal($id)
    {
        $this->confirmItemDeletion = $id;
    }


    /**
     * Delete  item
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        $this->confirmItemDeletion = false;
        $this->checkoutFormModal = false;
        session()->flash('message', 'Attendance deleted successfully.');
        $this->reset(['attendance']);
        return redirect()->back();
    }

    /**
     * close  modal and reset the form 
     */
    public function closeModal()
    {
        $this->confirmItemAdd = false;
        $this->checkoutFormModal = false;
        $this->reset(['attendance']);
    }


    /**
     * Secretariat Search
     */
    public function search()
    {
       
        $this->getDivisionName();
        $this->user_division = $this->division_id;
    }

 
    /**
     * Member Search
     */
    public function searchMember()
    {
   
        $this->getDivisionName();
        
        // Session::put('divisionId', $this->division_id);
        // $this->attendances = User::where('status', 1)->where('department_id', 2)->orderBy('display_order', 'asc')->get();
        // $this->getMemberStatistic();
        $this->user_division = $this->division_id;
       
    }

    public function getMemberStatistic()
    {

    if (Auth::check()) {
    // Get the logged-in user's division_id and department_id
    $divisionId = Auth::user()->division_id;
    $departmentId = Auth::user()->department_id;
    $today = date('Y-m-d');

    // Initialize total members, present members, and absent members
    $totalMembers = 0;
    $totalPresent = 0;
    $totalAbsent = 0;

    // Count total members in the logged-in user's department and division
    $totalMembers = User::where('status', 1)
                        ->where('department_id', $departmentId)
                        ->where('division_id', $divisionId)
                        ->get()->count();

    // Count members present today in the logged-in user's department and division
    $totalPresent = Attendance::where('status', 1)
                              ->where('department_id', $departmentId)
                              ->where('division_id', $divisionId)
                              ->where('created_at', 'like', $today . '%')
                              ->get()->count();

    // Calculate absent members
    $totalAbsent = $totalMembers - $totalPresent;

    // Assign the calculated values to the respective properties
    $this->totalmember_present = $totalPresent;
    $this->totalmember_absent = $totalAbsent;
    $this->totalmembers = $totalMembers;

} else {
    // Default values if the user is not authenticated
    $this->totalmember_present = 0;
    $this->totalmember_absent = 0;
    $this->totalmembers = 0;
} 

    }
    /**
     * Secretariat Search
     */
    public function getDivisionName()
    {
        if ($this->division_id == 0) { //ALL
            $userDivision = Auth::user()->division_id;
           
            $this->attendances = User::with('userstatus')->where('status', 1)->where('department_id', Auth::user()->department_id)->orderBy('display_order', 'asc')->get();
        } else{
            
    
            $this->attendances = User::where('status', 1)->where('division_id',$this->division_id)->orderBy('display_order', 'asc')->get();
        } 
        $this->getMemberStatistic();
        Session::put('divisionId', $this->division_id);
    }

      /**
     * return Member attendance record
     *
     * @return void
     */
    public function secretariatAttendanceRecord($userId)
    {
        $fromDate = Date('Y-m-d');
        $attendanceRecord = Attendance::with('user')->where('author', $userId)->where('created_at', 'like', $fromDate . '%')->get();
        return $attendanceRecord;
    }


    /**
     * return Member attendance record
     *
     * @return void
     */
    public function memberAttendanceRecord($userId)
    {
        // $fromDate = Session::get('fromDate');
        $fromDate = Date('Y-m-d');
        $attendanceRecord = Attendance::with('user')->where('author', $userId)->where('created_at', 'like', $fromDate . '%')->get();
        return $attendanceRecord;
    }
       
  /**
   * Updated User Status
   * @param  mixed $status
   * @return void
   */
  public function updateStatus()
  {
    $user = User::find(Auth::user()->id);
    $user->userstatus_id = $this->userstatus_id;
    $user->save();
    return redirect()->route('app.attendance.applications');
  }

      
  /**
   * Updated Member Status
   * @param  mixed $status
   * @return void
   */
  public function updateMemberStatus()
  {
    $user = User::find(Auth::user()->id);
    $user->userstatus_id = $this->userstatus_id;
    $user->save();
    return redirect()->route('app.attendance.applications');
  }

  /**
     * download application in pdf format
     */
    public function memberreportPdf()
    {
        $divId = Session::get('divisionId');

        if(!empty($divId)){
            if($divId == 7){ //All members
                $attendancereports = User::where('status', 1)->where('department_id', 2)->orderBy('display_order', 'asc')->get();
            }else{
                $attendancereports = User::where('status', 1)->where('department_id', 2)->where('division_id', $divId)->orderBy('display_order', 'asc')->get();
            }
        }else{
            $attendancereports = User::where('status', 1)->where('department_id', 2)->orderBy('display_order', 'asc')->get();
        }

        $fromDate = date('Y-m-d');
        $title = 'Members Attendance Report for '.$fromDate;
        $pdf = PDF::loadView(
            'livewire.memberattendancereports.member-report',
            compact('attendancereports', 'fromDate', 'title'),
            [],
            [
                'title' => 'Member Attendance Report',
                'format' => 'A4-L',
                'orientation' => 'L'
            ]
        );
        return $pdf->stream('member_attendance_report.pdf');
    }

    /**
     * export member in pdf format
     */
    public function memberPdf()
    {
        $label = '';
        $totalmember_present = 0;
        $totalmember_absent = 0;
        $totalmembers = 0;
        if(!empty($this->userstatus_id)){
            $attendancereports = User::where('status', 1)->where('userstatus_id',$this->userstatus_id)->where('department_id', 2)->orderBy('display_order', 'asc')->get();
        }
       
        $divId = Session::get('divisionId');

        if(!empty($divId)){
            if($divId == 7){ //All members
                $attendancereports = User::where('status', 1)->where('department_id', 2)->orderBy('display_order', 'asc')->get();
            }else{
                $attendancereports = User::where('status', 1)->where('department_id', 2)->where('division_id', $divId)->orderBy('display_order', 'asc')->get();
            }
        }else{
            $attendancereports = User::where('status', 1)->where('department_id', 2)->orderBy('display_order', 'asc')->get();
        }

        if(!empty($divId)){

            $today = date('Y-m-d');
            $totalmember_mp = User::where('status', 1)->where('department_id', 2)->where('division_id', 5)->get()->count();
            $totalmember_nc = User::where('status', 1)->where('department_id', 2)->where('division_id', 6)->get()->count();
           
            if($divId == 7){ //All members
                $totalmember_mp_present = Attendance::where('status', 1)->where('department_id', 2)->where('division_id', 5)->where('created_at','like',$today.'%')->get()->count();
                $totalmember_nc_present = Attendance::where('status', 1)->where('department_id', 2)->where('division_id', 6)->where('created_at','like',$today.'%')->get()->count();
                $totalmember_present =  $totalmember_mp_present + $totalmember_nc_present;
                $totalmember_absent =  ($totalmember_mp - $totalmember_mp_present) + ($totalmember_nc - $totalmember_nc_present);
                $totalmembers = $totalmember_present + $totalmember_absent;
                $label = "JS";
            }else{
                if($divId == 5){ //MP
                    $totalmember_present = Attendance::where('status', 1)->where('department_id', 2)->where('division_id', 5)->where('created_at','like',$today.'%')->get()->count();
                    $totalmember_absent = $totalmember_mp - $totalmember_present;
                    $totalmembers = $totalmember_present + $totalmember_absent;
                    $label = "MP";
                }
                if($divId == 6){ //NC
                    $totalmember_present = Attendance::where('status', 1)->where('department_id', 2)->where('division_id', 6)->where('created_at','like',$today.'%')->get()->count();
                    $totalmember_absent = $totalmember_nc - $totalmember_present;
                    $totalmembers = $totalmember_present + $totalmember_absent;
                    $label = "NC";
                }
            }
        }

        $fromDate = date('Y-m-d');
        $title = 'Members Attendance Report for '.$fromDate;
        $pdf = PDF::loadView(
            'livewire.memberattendancereports.report',
            compact('attendancereports', 'fromDate', 'label', 'title','totalmember_present','totalmember_absent','totalmembers'),
            [],
            [
                'title' => 'Member Attendance Report',
                'format' => 'A4-L',
                'orientation' => 'L'
            ]
        );
        return $pdf->stream('member_attendance_report.pdf');
    }

}
