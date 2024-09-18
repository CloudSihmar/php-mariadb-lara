<?php

namespace App\Http\Livewire;

use PDF;
use App\Models\User;
use App\Models\Leave;
use Livewire\Component;
use App\Models\Admin\Division;
use App\Http\Livewire\Utilities;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Leavecategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Request;

class LeaveReports extends Component
{
    public $fromDate;
    public $toDate;
    public $leaveType;
    public $leavecategories;
    public $leavereports;
    public $divisions;
    public $division_id;
    
    protected $rules = [
        'fromDate' => 'required',
        'toDate' => 'required',
        'division_id' => 'required',
        'leaveType' => 'required'
      ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    
    public function mount()
    {
    if (auth()->user()->can('leave.report')) {
        $this->leavecategories = Leavecategory::all();
        $this->leavereports = collect();
        $this->divisions = Division::where('department_id',1)->get();
    }else{
      abort(401);
    }

    }

    /**
    * render
    */
    public function render()
    {
        return view('livewire.leavereports.index')->layout(getLayout());
    }

    /**
    * search
    */
    public function search()
    {
        $this->validate([
            'fromDate' => 'required',
            'toDate' => 'required',
            'division_id' => 'required',
            'leaveType' => 'required'
          ],[
            'fromDate.required' => 'Please select fromDate',
            'toDate.required' => 'Please select toDate',
            'leaveType.required' => 'Please select Leave Type',
            'division_id.required' => 'Please select Division',
          ]);
          

        $user = User::find(Auth::user()->id);
        $userDeptId = $user->department_id;

        Session::put('fromDate', Utilities::formated_date($this->fromDate));
        Session::put('toDate', Utilities::formated_date($this->toDate));
        Session::put('leaveType', $this->leaveType);
        Session::put('deptId', $userDeptId);
        Session::put('division', $this->division_id);
      
        if($this->leaveType == 0 && $this->division_id == 0){
            $this->leavereports = Leave::with('user')->with('division')->where('department_id',$userDeptId)->whereBetween('fromDate',[ Utilities::formated_date($this->fromDate), Utilities::formated_date($this->toDate)])->get();
        }else if($this->leaveType == 0 && $this->division_id == 7){
            $this->leavereports = Leave::with('user')->with('division')->where('department_id',2)->whereBetween('fromDate',[ Utilities::formated_date($this->fromDate), Utilities::formated_date($this->toDate)])->get();
        }
        else if($this->division_id == 0){
            $this->leavereports = Leave::with('user')->with('division')->where('department_id',$userDeptId)->whereBetween('fromDate',[ Utilities::formated_date($this->fromDate), Utilities::formated_date($this->toDate)])->where('leave_category_id',$this->leaveType)->get();
        }else if(in_array($this->division_id,[5,6])){
            $this->leavereports = Leave::with('user')->with('division')->where('division_id',$this->division_id)->whereBetween('fromDate',[ Utilities::formated_date($this->fromDate), Utilities::formated_date($this->toDate)])->get();
        }else if($this->leaveType == 0){
            $this->leavereports = Leave::with('user')->with('division')->where('department_id',$userDeptId)->where('division_id',$this->division_id)->whereBetween('fromDate',[ Utilities::formated_date($this->fromDate), Utilities::formated_date($this->toDate)])->get();
        }
    }

  /**
   * download application in pdf format
   */
  public function downloadPdf()
  {
    $fromDate = Session::get('fromDate');
    $toDate = Session::get('toDate');
    $leaveType = Session::get('leaveType');
    $deptId = Session::get('deptId');
    $division_id = Session::get('division');

    if($leaveType == 0 && $division_id == 0){
        $leavereports = Leave::with('user')->with('division')->where('department_id',$deptId)->whereBetween('fromDate',[ Utilities::formated_date($fromDate), Utilities::formated_date($toDate)])->get();
    }else if($leaveType == 0 && $division_id == 7){
        $leavereports = Leave::with('user')->with('division')->where('department_id',2)->whereBetween('fromDate',[ Utilities::formated_date($fromDate), Utilities::formated_date($toDate)])->get();
    }
    else if($division_id == 0){
        $leavereports = Leave::with('user')->with('division')->where('department_id',$deptId)->whereBetween('fromDate',[ Utilities::formated_date($fromDate), Utilities::formated_date($toDate)])->where('leave_category_id',$leaveType)->get();
    }else if(in_array($division_id,[5,6])){
        $leavereports = Leave::with('user')->with('division')->where('division_id',$division_id)->whereBetween('fromDate',[ Utilities::formated_date($fromDate), Utilities::formated_date($toDate)])->get();
    }else if($leaveType == 0){
        $leavereports = Leave::with('user')->with('division')->where('department_id',$deptId)->where('division_id',$division_id)->whereBetween('fromDate',[ Utilities::formated_date($fromDate), Utilities::formated_date($toDate)])->get();
    }
    $pdf = PDF::loadView('livewire.leavereports.report',compact('leavereports', 'fromDate', 'toDate', 'leaveType'),
      [],
      [
        'title' => 'Leave Report',
        'format' => 'A4-L',
        'orientation' => 'L'
      ]
    );
    return $pdf->stream('leave_report.pdf');
  }
}

