<?php

namespace App\Http\Livewire;

use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Leave;
use Livewire\Component;
use App\Models\LeaveBalance;
use App\Models\Notification;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;
use App\Models\Admin\Division;
use App\Models\Admin\LeaveStatus;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Leavecategory;
use App\Models\SupervisorUpdatedLogs;
use Livewire\WithPagination;

class Leaveapplications extends Component
{
  use WithPagination;
  use WithFileUploads;

  public $leaveapp;
  public $leavescategories;
  public $confirmItemDeletion = false;
  public $confirmItemAdd = false;
  public $supervisorModel= false;
  public $approve = false;
  public $viewremark = false;
  public $eLeaveBalance;
  public $cLeaveBalance;
  public $flag;
  public $LEAVE_APPROVED = 1;
  public $LEAVE_REJECTED = 2;
  public $LEAVE_PENDING = 3;

  public $CASUAL_LEAVE = 3;
  public $EARNED_LEAVE = 4;

  public $ANNUAL_LEAVE = 18;

  public $document;
  public $divisions;
  public $supervisoruser;
  public $divisionHead;
  public $textRemarks;
  public $offciateFromDate;
  public $offciateToDate;
  public $offgtSupervisorCount;
  public $subStaffIds;

  public $division_id;
  public $staffLists;
  public $supervisoruser_id;
  
  protected $rules = [
    'leaveapp.fromDate' => 'required',
    'leaveapp.toDate' => 'required',
    'leaveapp.leave_category_id' => 'required',
    'leaveapp.employeeRemarks' => 'nullable',
    'leaveapp.headRemarks' => 'nullable',
    'leaveapp.status' => 'nullable',
    'document' => 'nullable|file|mimes:jpeg,png,jpg,pdf'
  ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount(){
      $today = date('Y-m-d');

      $result = User::find(Auth::user()->id);
      $this->divisions = Division::all();

      $this->staffLists = User::where('division_id',Auth::user()->division_id)->where('id','!=',1)->get();

      $this->subStaffIds = $result->users_ids_array;
      $this->supervisoruser_id = $result->headId;

      $userDtlsRecord = User::where('id',Auth::user()->id)->whereIn('department_id',[1,2])->where('status',1)->where('display_order',1)->get();
      if(count($userDtlsRecord) > 0){
        $this->subStaffIds = $userDtlsRecord->first()->users_ids_array;
      }else{
        if(empty($this->subStaffIds)){
          $result = SupervisorUpdatedLogs::where('fromdate','<=',$today)->where('todate','>=',$today)->where('new_headId',Auth::user()->id)->orderByDesc('id')->limit(1)->get();
          if(count($result) > 0)
            {
              $this->subStaffIds = $result->first()->user_id;
            }
        }
        else{
          $result = SupervisorUpdatedLogs::where('fromdate','<=',$today)->where('todate','>=',$today)->where('new_headId',Auth::user()->id)->orderByDesc('id')->limit(1)->get();
          if(count($result) > 0){
            $this->subStaffIds = $result->first()->user_id;
          }else{
            $userDtlsRecordA = User::where('id',Auth::user()->id)->where('status',1)->get();
            if(!empty($userDtlsRecordA->first()->users_ids_array)){
              $this->subStaffIds = $userDtlsRecordA->first()->id;;
            }else{
              $this->subStaffIds = '';
            }
          }
        }
      }
    }

  /**
   * Render page
   *
   * @return void
   */
  public function render()
  {
    $leavecategories = Leavecategory::all();
    $leaveBalance = LeaveBalance::where('user_id',Auth::user()->id)->first();

    if(isset($leaveBalance->id)){
      $this->eLeaveBalance = $leaveBalance->earn_leave;
      $this->cLeaveBalance = $leaveBalance->casual_leave;
    }

    $perPage = 25;
    $today = Date('Y-m-d');
    
    $users = User::find(Auth::user()->id);

    //check n send to offgtt head
    // $resultA = SupervisorUpdatedLogs::where('new_headId',Auth::user()->id)->orderBy('id','desc')->take(1)->get();
    // $resultA = SupervisorUpdatedLogs::where('fromdate','<=',$today)->where('todate','>=',$today)->where('new_headId',Auth::user()->id)->orderByDesc('id')->limit(1)->get();
        
    // if(count($resultA) > 0)
    // {
    //   $startDate = \Carbon\Carbon::createFromFormat('Y-m-d',$resultA[0]->fromdate);
    //   $endDate = \Carbon\Carbon::createFromFormat('Y-m-d',$resultA[0]->todate);
    //   $check = \Carbon\Carbon::now()->between($startDate,$endDate);
      
    //   if($check){
    //   }
    // }
    
    $offgtSupervisorCount = SupervisorUpdatedLogs::where('fromdate','<=',$today)->where('todate','>=',$today)->where('new_headId',Auth::user()->id)->orderByDesc('id')->limit(1)->get();
    
    if(count($offgtSupervisorCount) > 0){
      $sub_staff = $offgtSupervisorCount->first()->user_id;
    }else{
      $sub_staff = $users->users_ids_array;
    }

    if(!empty($sub_staff)){
      $sub_staff = $sub_staff.','.$users->users_ids_array.','.Auth::user()->id;
      $explode_id = array_map('intval', explode(',', $sub_staff));
      $leaves = Leave::with('leavetype')->with('leavestatus')->with('user')->with('approve')->whereIn('author', $explode_id)->orderBy('created_at', 'desc')->paginate($perPage);
    }else{
      $leaves = Leave::with('leavetype')->with('leavestatus')->with('user')->with('approve')->where('author',Auth::user()->id)->orderBy('created_at', 'desc')->paginate($perPage);
    }

    return view('livewire.leaveapplications.index', compact('leaves','leavecategories'))->layout(getLayout());

  }

  /**
   * Approve leave
   *
   * @return void
   */
  public function update()
  {
    if($this->leaveapp['status'] != $this->LEAVE_PENDING){ 

      $headRemarks = !empty($this->leaveapp['headRemarks'])? $this->leaveapp['headRemarks']:'';
      $emailTitle = ($this->leaveapp['status'] == $this->LEAVE_APPROVED) ? "Leave Approved":"Leave Rejected";
      
      if(empty($headRemarks)){
        $headRemarks = ($this->leaveapp['status'] == $this->LEAVE_APPROVED) ? "Leave Approved":"Leave Rejected";
      } 
      
      $data = array(
        "fromDate" => $this->leaveapp['fromDate'],
        "toDate" => $this->leaveapp['toDate'],
        "headRemarks" =>$headRemarks,
        "status" => $this->leaveapp['status'],
        "actionby" => Auth::user()->id
      );

      $leave = Leave::find($this->leaveapp->id);
      $applicant = $leave->author;
      $leave->update($data);

      if($this->leaveapp['status'] == $this->LEAVE_APPROVED){ 
        $leavecategory= $leave->leave_category_id;
        if($leavecategory == $this->CASUAL_LEAVE || $leavecategory == $this->EARNED_LEAVE || $leavecategory == $this->ANNUAL_LEAVE ){ 
          $this->LeaveBalanceUpdate($applicant,$headRemarks,$leavecategory,$this->leaveapp['fromDate'],$this->leaveapp['toDate']);
        }
       // Utilities::insertAttendanceLeaveRecord($applicant, $newDateTime, $leave->leave_category_id, $this->leaveapp['fromDate'], $this->leaveapp['toDate']);
      }else { //Reject Leave Application
        SupervisorUpdatedLogs::where('fromdate',$this->leaveapp['fromDate'])->where('todate',$this->leaveapp['toDate'])->where('old_headId',$applicant)->delete();
      }

      Utilities::updateNotification($this->leaveapp->id);
      Utilities::sendNotification($this->leaveapp->id, $leave->author, $headRemarks, 'notifications.leave-notifications');
    
      $userDtls = User::find($applicant);
      //$emailBody = 'Dear '.$userDtls->name.', Your Leave application has been : '.$headRemarks;
      // Utilities::sendMail($userDtls->email, $emailTitle, $emailBody);
    
      session()->flash('message', 'Leave application successfully taken action!');
    }else{
      session()->flash('error', 'Select the leave action!');
    }
    $this->reset(['leaveapp']);
    $this->confirmItemAdd = false;
    $this->approve = false;
    
  }
     
  public function LeaveBalanceUpdate($applicant,$headRemarks,$leavecategory,$from,$to)
  {
    $leavedata['user_id'] = $applicant;
    $leavedata['remarks'] = $headRemarks;
    $leavedata['author'] = Auth::user()->id;
    $leaveBalance = LeaveBalance::where('user_id',$applicant)->first();
    
    $days = Utilities::getWorkingDays($from,$to);

    if($leavecategory == $this->ANNUAL_LEAVE){ 
      $leavedata['earn_leave'] = $leaveBalance->earn_leave - $days;
    }

    // if($leavecategory == $this->CASUAL_LEAVE){ 
    //   $leavedata['casual_leave'] = $leaveBalance->casual_leave - $days;
    // }
    // if($leavecategory == $this->EARNED_LEAVE){ 
    //   $leavedata['earn_leave'] = $leaveBalance->earn_leave - $days;;
    // }
    $currentDateTime = Carbon::now();
    $newDateTime = Carbon::now()->addHour(6);
    $leaveBalance->update($leavedata);
  }

  public function transfersupervisor()
  {
    $this->divisions = Division::all();
    $this->confirmItemAdd = false;
    $this->supervisorModel = true;
    $this->approve = false;
  }

  public function updateSupervisor($from, $to, $textRemarks)
  {
    $user = User::find(Auth::user()->id);
    $substaffList = $user->users_ids_array;
    
    if(empty($substaffList)){
      $substaff = SupervisorUpdatedLogs::where('new_headId',Auth::user()->id)->get()->first();
      $substaffList =  !empty($substaff) ? $substaff->user_id : 0;
    }

    $old_headId = !empty($user->old_headId) ? $user->old_headId : Auth::user()->id;
    $newSupervisor = !empty($this->supervisoruser) ? $this->supervisoruser : '';
    
    $this->saveSupervisorLogs($old_headId, $newSupervisor, $substaffList, $from, $to, $textRemarks);

    session()->flash('message', 'Supervisor successfully updated!');
    $this->confirmItemAdd = false;
    $this->supervisorModel = false;
    $this->approve = false;
  }


  /**
   * Check leave Balance
   *
   * @return void
   */

  public function saveSupervisorLogs($old_headId,$newHeadId, $user_ids, $from, $to, $remarks)
  {
    if(!empty($newHeadId)){
      SupervisorUpdatedLogs::create([
        'old_headId' => $old_headId,
        'new_headId' => $newHeadId,
        'user_id' => $user_ids,
        'fromdate' => $from,
        'todate' => $to,
        'remarks' => $remarks,
        'author' => Auth::user()->id,
      ]);
    }
  }
  /**
   * Check leave Balance
   *
   * @return void
   */

  public function checkLeaveBalance($leaveType, $leaveBalance, $days)
  {
    $this->flag = false;
    if(in_array($leaveType,[$this->CASUAL_LEAVE,$this->EARNED_LEAVE,$this->ANNUAL_LEAVE])){
      $checkLeaveRecordCount = LeaveBalance::where('user_id',Auth::user()->id)->count();
      if($checkLeaveRecordCount > 0){
        $this->flag = true;
      }
    }else{
      $this->flag = true;
    }

    if($leaveType == $this->CASUAL_LEAVE && $this->flag) { 
      $balance =  $leaveBalance->casual_leave - $days;
      if($balance > 0){
        $this->flag = true;
      }
    } 
    
    if($leaveType == $this->EARNED_LEAVE && $this->flag) 
    { 
      $balance =  $leaveBalance->earn_leave - $days;
      if($balance > 0){
        $this->flag = true;
      }
    }
  }

  /**
   * store  data
   *
   * @return void
   */

  public function store()
  {
    $today = date('Y-m-d');
    $this->validate();
    if(!empty($this->document)){
      $filepath = $this->document->storeAs('Leave', time() . '_' . time(). '.' . $this->document->extension(), 'uploads');
    }
    $from_date = Utilities::formated_date($this->leaveapp['fromDate']);
    $to_date = Utilities::formated_date($this->leaveapp['toDate']);
    $leave_category_id = $this->leaveapp['leave_category_id'];

    $count = Leave::whereBetween('fromDate',[$from_date,$to_date])->whereIn('status',[$this->LEAVE_PENDING, $this->LEAVE_APPROVED])->where('author',Auth::user()->id)->get()->count();

    $leaveBalance = LeaveBalance::where('user_id',Auth::user()->id)->first();

    $days = Utilities::getWorkingDays($from_date, $to_date);
    
    $this->checkLeaveBalance($leave_category_id, $leaveBalance, $days);

    if($count==0 && $this->flag){
      $userResult = User::where('id', Auth::user()->id)->first();
      $agency_id= $userResult->agency_id;
      $department_id= $userResult->department_id;
      $division_id= $userResult->division_id;
      $document = !empty($filepath) ? $filepath : '';
      $employeeRemarks = !empty($this->leaveapp['employeeRemarks'])? $this->leaveapp['employeeRemarks']:'';
     
      $userDtlsRecord = User::where('id',Auth::user()->id)->whereIn('department_id',[1,2])->where('status',1)->where('display_order',1)->get();

        //Added on 14May 2024 to auto approve leave other than CL & AL
      if(!in_array($leave_category_id, [3,18])) {
        $this->autoApproveLeave($document,$from_date,$to_date,$leave_category_id,$agency_id,$department_id,$division_id,$employeeRemarks);
      }else{

      if($userDtlsRecord->count() > 0){
          //Auto approved for Head of Agency
          $this->autoApproveLeave($document,$from_date,$to_date,$leave_category_id,$agency_id,$department_id,$division_id,$employeeRemarks);
          //Offgtt update
          $this->updateSupervisor($from_date, $to_date, $employeeRemarks);
      }else{
          $result = SupervisorUpdatedLogs::where('fromdate','<=',$today)->where('todate','>=',$today)->where('new_headId',Auth::user()->id)->orderByDesc('id')->limit(1)->get();
          if(count($result) > 0)
          {
            $this->autoApproveLeave($document,$from_date,$to_date,$leave_category_id,$agency_id,$department_id,$division_id,$employeeRemarks);
            //Offgtt update
            $this->updateSupervisor($from_date,$to_date,$employeeRemarks);
          }else{
            if(!empty($this->subStaffIds)) {
              if(empty($this->supervisoruser_id)){
                //Check for Head of Division, then Auto approve
                $this->autoApproveLeave($document,$from_date,$to_date,$leave_category_id,$agency_id,$department_id,$division_id,$employeeRemarks);
              }else{
                $insertedId = $this->saveLeave($document,$from_date,$to_date,$leave_category_id,$agency_id,$department_id,$division_id,$employeeRemarks);
                //Offgtt update
                $this->updateSupervisor($from_date,$to_date,$employeeRemarks);
                Utilities::sendNotification($insertedId->id, $userResult->headId, $employeeRemarks, 'notifications.leave-notifications');
              }
            }else{
              $insertedId = $this->saveLeave($document,$from_date,$to_date,$leave_category_id,$agency_id,$department_id,$division_id,$employeeRemarks);

              $supevisor = !empty($userResult->headId) ?  $userResult->headId : 0;
              $offgtSupervisorDtl = SupervisorUpdatedLogs::where('fromdate','<=',$today)->where('todate','>=',$today)->where('old_headId',$supevisor)->get();
              if(count($offgtSupervisorDtl) > 0){
                $supevisor = $offgtSupervisorDtl->first()->new_headId;
              }
              Utilities::sendNotification($insertedId->id, $supevisor, $employeeRemarks, 'notifications.leave-notifications');
            }
          }
      }
         } //End 14thMay2024
      session()->flash('message', 'Leave application successfully submitted!');
    }else{
        session()->flash('error', 'Insufficient leave balance or application already submitted/approved!');
    }

    $this->reset(['leaveapp']);
    $this->confirmItemAdd = false;
    $this->approve = false;
    $this->flag = false;
    return redirect()->back();
  }

  public function saveLeave($document,$fromDate,$toDate,$leave_category_id,$agency_id,$department_id,$division_id,$employeeRemarks)
  {
   $result = Leave::create([
      'document' => $document,
      'fromDate' => $fromDate,
      'toDate' => $toDate,
      'leave_category_id' => $leave_category_id,
      'employeeRemarks' => $employeeRemarks,
      'agency_id' => $agency_id,
      'department_id' => $department_id,
      'division_id' => $division_id,
      'status' => $this->LEAVE_PENDING,
      'actionby' => 0,
      'author' => Auth::user()->id,
    ]);
    return $result;
  }

  public function autoApproveLeave($document,$fromDate,$toDate,$leave_category_id,$agency_id,$department_id,$division_id,$employeeRemarks)
  {
    $currentDateTime = Carbon::now();
    $newDateTime = Carbon::now()->addHour(6);
    //Utilities::insertAttendanceLeaveRecord(Auth::user()->id, $newDateTime, $leave_category_id, $fromDate, $toDate);
  
    Leave::create([
      'document' => $document,
      'fromDate' => $fromDate,
      'toDate' => $toDate,
      'leave_category_id' => $leave_category_id,
      'employeeRemarks' => $employeeRemarks,
      'agency_id' => $agency_id,
      'department_id' => $department_id,
      'division_id' => $division_id,
      'status' => $this->LEAVE_APPROVED,
      'actionby' => Auth::user()->id,
      'author' => Auth::user()->id,
    ]);
    if($leave_category_id == $this->CASUAL_LEAVE || $leave_category_id == $this->EARNED_LEAVE || $leave_category_id == $this->ANNUAL_LEAVE ){ 
     $this->LeaveBalanceUpdate(Auth::user()->id,$employeeRemarks,$leave_category_id,$fromDate,$toDate);
    }
  }

  public function approve(Leave $leaveapp)
  {
    $this->leaveapp = $leaveapp;
    $this->confirmItemAdd = false;
    $this->approve = true;
  }

  public function cancel(Leave $leaveapp)
  {
    $leaveapp->delete();
    $this->confirmItemDeletion = false;
    session()->flash('message', 'Leave deleted successfully.');
    $this->reset(['leaveapp']);
    return redirect()->back();
  }
  
  public function viewremark(Leave $leaveapp)
  {
    $this->leaveapp = $leaveapp;
    $this->confirmItemAdd = false;
    $this->viewremark = true;
  }
  
  public function updateRemark()
  {
    Utilities::updateNotification($this->leaveapp->id);
    $this->viewremark = false;
    $this->confirmItemAdd = false;
    $this->approve = false;
  }
  
  /**
   * display edit modal (route - model binding)
   */
  public function showEditModal(Leave $leaveapp)
  {
    $this->leaveapp = $leaveapp;
    $this->confirmItemAdd = true;
    $this->approve = false;
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
  public function destroy(Leave $leaveapp)
  {
     //Remove from offgtt
    SupervisorUpdatedLogs::where('fromdate',$leaveapp['fromDate'])->where('todate',$leaveapp['toDate'])->where('author',Auth::user()->id)->delete();
    $leaveapp->delete();
    $this->confirmItemDeletion = false;
    session()->flash('message', 'leave deleted successfully.');
    $this->reset(['leaveapp']);
    return redirect()->back();
  }

  /**
   * close  modal and reset the form 
   */
  public function closeModal()
  {
    $this->confirmItemAdd = false;
    $this->supervisorModel = false;
    $this->approve = false;
    $this->reset(['leaveapp']);
  }


  /**
   * UpdatedUserDepartmentId
   * @param  mixed $depID
   * @return void
   */
  public function UpdatedDivisionId($id)
  {
    // $this->staffLists = User::where("division_id", $id)->get();
  }
  
  /**
   * download
   * @param  mixed $id
   * @return void
   */
  public function download($id)
  {
    $attachment = Leave::where('id', $id)->firstOrFail();
    $file_path = public_path('uploads/' . $attachment->document);
    return response()->download($file_path);
  }

}

