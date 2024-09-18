<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Auth;
use PDF;

use App\Models\LeaveBalance;
use function Symfony\Component\HttpKernel\Profiler\collect;
use App\Models\Admin\Division;

class LeaveBalances extends Component
{
  public $leavebalanceapp;
  public $confirmItemEdit = false;
  public $userleavebalances;

  public $division_id;
  public $divisions;

  protected $rules = [
    'leavebalanceapp.earn_leave' => 'required',
    'leavebalanceapp.casual_leave' => 'required',
    'leavebalanceapp.remarks' => 'nullable',
    'leavebalanceapp.author' => 'nullable',
    'leavebalanceapp.user_id' => 'nullable',
  ];

  public function mount()
  {
    $this->userleavebalances = User::with('balanceleave')->where('status',1)->orderBy('display_order', 'asc')->get();
    $this->divisions = Division::all();
  }

  public function render()
  {
    return view('livewire.leavebalances.index')->layout(getLayout());
  }

  public function update()
  {
    $this->validate();
    $this->leavebalanceapp->save();

    session()->flash('message', 'Leave balance updated successfully.');
    $this->reset(['leavebalanceapp']);
    $this->confirmItemEdit = false;
    return redirect()->route('app.leavebalance.applications');
  }


  /**
   * Secretariat Search
   */
  public function search()
  {
    Session::put('division_id', $this->division_id);
    if (empty($this->division_id)) {
      $this->userleavebalances = User::with('balanceleave')->where('status',1)->orderBy('display_order', 'asc')->get();
    } else {
      $this->userleavebalances = User::with('balanceleave')->where('status',1)->where('division_id','=', $this->division_id)->orderBy('display_order', 'asc')->get();
    }

  }


  /**
   * display edit modal (route - model binding)
   */
  public function showEditModal(User $user)
  {
    $leavebalance = LeaveBalance::where('user_id', $user->id)->get()->first();
    if($leavebalance == null){
     LeaveBalance::create([
                    'user_id' => $user->id,
                    'earn_leave' =>  0,
                    'casual_leave' => 0,
                    'author' => Auth::user()->id
                ]);
      $leavebalance = LeaveBalance::where('user_id', $user->id)->get()->first();
     }
    $this->leavebalanceapp = $leavebalance;
    $this->confirmItemEdit = true;
  }

  /**
   * close  modal and reset the form 
   */
  public function closeModal()
  {
    $this->reset(['leavebalanceapp']);
    $this->confirmItemEdit = false;
  }


    /**
     * download application in pdf format
     */
    public function downloadPdf()
    {
        $division_id = Session::get('division_id', $this->division_id);
        if (empty($division_id)) {
          $userleavebalances = User::with('division')->with('balanceleave')->where('status',1)->orderBy('display_order', 'asc')->get();
        } else {
          $userleavebalances = User::with('division')->with('balanceleave')->where('status',1)->where('division_id','=', $division_id)->orderBy('display_order', 'asc')->get();
        }
        
        $title = 'Leave Balance ' . $division_id;
        $pdf = PDF::loadView(
            'livewire.leavebalances.report',
            compact('userleavebalances','division_id', 'title'),
            [],
            [
                'title' => 'Leave Report',
                'format' => 'A4-L',
                'orientation' => 'L'
            ]
        );
        return $pdf->stream('leavebalances_report.pdf');
    }

}

