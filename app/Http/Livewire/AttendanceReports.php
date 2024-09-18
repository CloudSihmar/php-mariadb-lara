<?php

namespace App\Http\Livewire;

use PDF;
use App\Models\User;
use App\Models\Leave;
use Livewire\Component;
use App\Models\Attendance;
use App\Models\Admin\Dzongkhag;
use App\Models\Admin\Constituency;
use App\Models\Admin\Leavecategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Admin\Division;


class AttendanceReports extends Component
{
    public $division_id;
    public $agency_id;
    public $month;
    public $year;
    public $supervisor;
    public $totalleavePending;
    public $totalLateAttendance;
    public $totalstaffLeave;
    public $leavecategories;
    public $leaves;
    public $attendancereports;
    public $totalnotusedAttendance;
    public $fromDate;
    public $MEMBER_DEPT = 2;
    public $attendance_reports;

    public $catID;
    public $divisions;

    public function mount($catID)
    {
        $this->catID = $catID;
        $this->leavecategories = collect();
        $this->attendancereports = collect();
        $this->attendance_reports = collect();
        $this->leaves = collect();
        $this->divisions = Division::all();
    }

    public function render()
    {
        $today = Date('Y-m-d');
    //     $this->attendancereports = Attendance::with('user')->where('inStatus', 'Late')->where('department_id', Auth::user()->department_id)->where('created_at', 'like', $today . '%')->get();
    //    //dd("sirjfjsiod");
    //     return view('livewire.attendancereports.memberlatereport')->layout(getLayout());
//dd($this->catID);
       
        if ($this->catID == 8) { //Secretariat Staff Leave Pending
            $this->attendancereports = Leave::with('user')->with('leavestatus')->with('leavetype')->where('status', 3)->where('department_id', Auth::user()->department_id)->get();
            return view('livewire.attendancereports.pendingleavereport')->layout(getLayout());
        }elseif ($this->catID == 1) { //Secretariat Late Attendance 
            $this->attendancereports = Attendance::with('user')->where('inStatus', 'Late')->where('department_id', 1)->where('created_at', 'like', $today . '%')->get();
            return view('livewire.attendancereports.latereport')->layout(getLayout());
        } else if ($this->catID == 2) { //Secretariat Staff on Leave 
            $this->attendancereports = Leave::with('user')->with('leavestatus')->with('leavetype')->where('status', 1)->where('toDate', '>=', $today)->where('department_id', Auth::user()->department_id)->get();
            return view('livewire.attendancereports.officialleavereport')->layout(getLayout());
        }else if ($this->catID == 3) { //Secretariat Staff Not used attendance
            $this->attendancereports = User::where('status', 1)->where('department_id',  Auth::user()->department_id)->get();
            return view('livewire.attendancereports.notusedreport')->layout(getLayout());
        } else if ($this->catID == 4) { //Member Pending Leave
            $this->attendancereports = Leave::with('user')->with('leavestatus')->with('leavetype')->where('status', 3)->where('department_id', Auth::user()->department_id)->get();
            return view('livewire.attendancereports.memberpendingleavereport')->layout(getLayout());
        } else if ($this->catID == 5) { //Member Late Attendance 
            $this->attendancereports = Attendance::with(['user','division'])->where('inStatus', 'Late')->where('department_id', Auth::user()->department_id)->where('created_at', 'like', $today . '%')->get();
            return view('livewire.attendancereports.memberlatereport')->layout(getLayout());
        } else if ($this->catID == 6) { //Member Not used Attendance 
            $this->attendancereports = User::where('status', 1)->where('department_id', Auth::user()->department_id)->get();
            return view('livewire.attendancereports.membernotusedreport')->layout(getLayout());
        }else if ($this->catID == 7) { //Member on Leave 
            $this->attendancereports = Leave::with('user')->with('leavestatus')->with('leavetype')->where('status', 1)->where('toDate', '>=', $today)->where('department_id', 2)->get();
            return view('livewire.attendancereports.memberofficialleavereport')->layout(getLayout());
        }else if ($this->catID == 0) { //Secretariat Attendance Report
            return view('livewire.attendancereports.index')->layout(getLayout());
        }else if ($this->catID == 9) { //Members Attendance Report
            $this->attendancereports = collect();
            return view('livewire.attendancereports.memberindex')->layout(getLayout());
        }else if ($this->catID == 10) { //Secretariat Daily Attendance Report
            $this->attendancereports = collect();
            return view('livewire.attendancereports.dailyattendancereport')->layout(getLayout());
        }
        

        $user_division = Auth::user()->division_id;
        if (in_array($user_division, [7,9,12])) {//Member
            return view('livewire.memberattendancereports.index')->layout(getLayout());
        } else {
            return view('livewire.attendancereports.index')->layout(getLayout());
        }
    }

    public function search()
    {
        $this->validate([
            'division_id' => 'required',
            'month' => 'required',
            'year' => 'required',
        ], [
            'division_id.required' => 'Please select division',
            'month.required' => 'Please select month',
            'year.required' => 'Please select year',
        ]);
        $this->leavecategories = Leavecategory::get();

        if ($this->division_id == 0) {
            $this->attendancereports = User::where('status',1)->where('department_id', 1)->orderBy('display_order','asc')->get(['id', 'name', 'empid', 'cid', 'department_id']);
        } else {
            $this->attendancereports = User::where('status',1)->where('division_id', $this->division_id)->get();
        }

        Session::put('year', $this->year);
        Session::put('month', $this->month);
        Session::put('divisionId', $this->division_id);

        $userId = User::find(Auth::user()->id);
        $this->supervisor = User::where('id', $userId->headId)->get()->first();
    }

    public function searchMember()
    {
        Session::put('fromDate', $this->fromDate);
        $this->attendancereports = User::where('status', 1)->where('department_id', $this->MEMBER_DEPT)->orderBy('display_order', 'asc')->get();
    }

      /**
     * return Member attendance record
     *
     * @return void
     */
    public function staffAttendanceRecord($userId)
    {
        $fromDate = Session::get('fromDate');
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
        $fromDate = Session::get('fromDate');
        $attendanceRecord = Attendance::with('user')->where('author', $userId)->where('created_at', 'like', $fromDate . '%')->get();

        return $attendanceRecord;
    }

    /**
     * download application in pdf format
     */
    public function downloadPdf()
    {
        $year = Session::get('year');
        $month = Session::get('month');
        $division_id = Session::get('divisionId');

        $leavecategories = Leavecategory::get();

        if ($division_id == 0) {
            $attendancereports = User::distinct()->where('status',1)->where('department_id', 1)->orderBy('display_order', 'asc')->get();//['id', 'name', 'empid', 'cid', 'department_id']);
        } else {
            $attendancereports = User::where('status',1)->where('division_id', $division_id)->orderBy('display_order', 'asc')->get();
        }

        $title = '';

        $pdf = PDF::loadView(
            'livewire.attendancereports.report',
            compact('attendancereports', 'year', 'month', 'division_id', 'leavecategories', 'title'),
            [],
            [
                'title' => 'Attendance Report',
                'format' => 'A4-L',
                'orientation' => 'L'
            ]
        );
        return $pdf->stream('attendance_report.pdf');

    }

    /**
     * download application in pdf format
     */
    public function exportdailyreportPdf()
    {
        $fromDate = Session::get('fromDate');
        $divisionId = Session::get('divisionId');

        if(!empty($divisionId)){
            $attendance_reports = User::where('status', 1)->where('department_id', 1)->where('division_id', $divisionId)->orderBy('display_order', 'asc')->get();
        }else{
            $attendance_reports = User::where('status', 1)->where('department_id', 1)->orderBy('display_order', 'asc')->get();
        }

        $title = 'Daily Attendance Report';

        $pdf = PDF::loadView(
            'livewire.attendancereports.dailyattendancereportpdf',
            compact('attendance_reports', 'divisionId', 'fromDate', 'title'),
            [],
            [
                'title' => 'Daily Attendance Report',
                'format' => 'A4-L',
                'orientation' => 'L'
            ]
        );
        return $pdf->stream('attendance_report.pdf');

    }
    /**
     * download application in pdf format
     */
    public function downloadMemberPdf()
    {
        $fromDate = Session::get('fromDate');
        $divisionId = Session::get('divisionId');
        $attendancereports = User::where('status', 1)->where('department_id', $this->MEMBER_DEPT)->where('division_id',$divisionId)->orderBy('display_order', 'asc')->get();
        $title = 'Attendance for ' . $fromDate;
        $pdf = PDF::loadView(
            'livewire.memberattendancereports.report',
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

    public function getUserRecord($userId)
    {
        $today = Date('Y-m-d');
        $result = Attendance::with('user')->where('author', $userId)->where('created_at', 'like', $today . '%')->get();
        return $result;
    }

    
    public function memberexportreportPdf()
    {
        $fromDate = Session::get('fromDate');
        $divisionId = Session::get('divisionId');

        if(empty($divisionId)){
            $label = "NA";
            $attendance_reports = User::where('status', 1)->where('department_id', 2)->orderBy('display_order', 'asc')->get();
        }elseif($this->division_id == 7){ //All members
            $label = "JS";
            $attendance_reports = User::where('status', 1)->where('department_id', 2)->orderBy('display_order', 'asc')->get();
        }else{
            $label = "NA";
            $attendance_reports = User::where('status', 1)->where('department_id', 2)->where('division_id', $divisionId)->orderBy('display_order', 'asc')->get();
        }

       
        
        $title = 'Attendance Report for ' . $fromDate;
        $pdf = PDF::loadView(
            'livewire.memberattendancereports.memberexportreport',
            compact('attendance_reports', 'fromDate', 'title','label'),
            [],
            [
                'title' => 'Member Attendance Report',
                'format' => 'A4-L',
                'orientation' => 'L'
            ]
        );
        return $pdf->stream('member_attendance_report.pdf');
    }


    public function searchMembersAttenance()
    {
        Session::put('fromDate', $this->fromDate);
        Session::put('divisionId', $this->division_id);
        
        if(empty($this->division_id)){
            $this->attendance_reports = User::where('status', 1)->where('department_id', 2)->orderBy('display_order', 'asc')->get();
        }elseif($this->division_id == 7){ //All members
            $this->attendance_reports = User::where('status', 1)->where('department_id', 2)->orderBy('display_order', 'asc')->get();
        }else{
            $this->attendance_reports = User::where('status', 1)->where('department_id', 2)->where('division_id', $this->division_id)->orderBy('display_order', 'asc')->get();
        }
    }

    public function searchDailyAttenanceReport()
    {
        Session::put('fromDate', $this->fromDate);
        Session::put('divisionId', $this->division_id);

        if(!empty($this->division_id)){
            $this->attendance_reports = User::where('status', 1)->where('department_id', 1)->where('division_id', $this->division_id)->orderBy('display_order', 'asc')->get();
        }else{
            $this->attendance_reports = User::where('status', 1)->where('department_id', 1)->orderBy('display_order', 'asc')->get();
        }
    }
}

