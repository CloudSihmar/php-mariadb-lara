<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Workflow;
use App\Models\Admin\Agency;
use App\Models\Notification;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use App\Models\Admin\Division;
use App\Models\Admin\Fileindex;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Workflows extends Component
{
  use WithPagination;
  public $workflow;
  public $agencies;
  public $activityLogs;
  public $name;
  public $content;
  public $remarks;
  public $confirmItemDeletion = false;
  public $confirmItemAdd = false;
  public $forward = false;
  public $showactivity = false;
  public $edit = false;
  public $writecomment;
  public $comment;
  public $user;
  public $divisions;
  public $fromDate;
  public $toDate;

  public $divisionid;
  public $staffLists;

  protected $rules = [
    'name' => 'required',
    'content' => 'required',
  ];

    
    /**
     * mount
     * @return void
     */
    public function mount(){
      $this->activityLogs = collect();
      $this->staffLists = collect();

      if (auth()->user()->can('workflow')) {
        $this->divisions = Division::orderBy('name','asc')->get();
      }else{
        abort(401);
      }
    }
    
    /**
     * render
     *
     * @return void
     */
    public function render()
    {
      $perPage = 35;
      $this->agencies = Agency::orderBy('name','asc')->get();
      // $workflows = Workflow::with('user')->where('author',Auth::user()->id)->orderBy('created_at', 'desc')->paginate($perPage);
      $workflows_user = Workflow::where('author',Auth::user()->id)->orderBy('id', 'desc');//->take($perPage);
      $workflows = DB::table('workflows')
                        ->leftjoin('notifications', 'workflows.id', '=', 'notifications.fid')
                        ->where('notifications.forward_to','=',Auth::user()->id)
                        ->select('workflows.*')
                        ->union($workflows_user)->orderBy('id', 'desc')
                        ->take($perPage)
                        ->get();
      return view('livewire.workflows.index', compact('workflows'))->layout(getLayout());
    }

    /**
    * search
    */
    public function search()
    {
      $perPage = 35;
        $this->validate([
            'fromDate' => 'required',
            'toDate' => 'required',
          ],[
            'fromDate.required' => 'Please select fromDate',
            'toDate.required' => 'Please select toDate',
          ]);
          
        Session::put('fromDate', $this->fromDate);
        Session::put('toDate', $this->toDate);
        
       $this->workflows = Workflow::with('user')->whereBetween('created_date',[$this->fromDate,$this->toDate])->get();
    }

     /**
     * store user comments
     * @return void
     */
    public function savecomment(Workflow $workflow)
    {
     Utilities::sendNotification($this->workflow->id,Auth::user()->id,$this->comment, 'workflow');
     session()->flash('message', 'Your comment is successfully saved!');
     $this->reset(['comment']);
     $this->confirmItemAdd = false;
     $this->showactivity = false;
     $this->writecomment = false;
     $this->forward = false;
    }

     /**
     * forward window popup
     * @return void
     */
    public function forwardModal(Workflow $workflow)
    {
      $this->workflow = $workflow;
      $this->confirmItemAdd = false;
      $this->showactivity = false;
      $this->forward = true;
    }

   /**
     * forward letter
     * @return void
     */
    public function forwardTo(Request $request, Workflow $workflow)
    {
      
      Utilities::sendNotification($this->workflow->id,$this->user,$this->remarks, 'workflow');
     
      $userDtls = User::find($this->user);
      $emailTitle = 'Work Flow Notification';
      $emailBody = 'Dear '.$userDtls->name.',Your have received work flow to take action.'.$this->remarks;
      // Utilities::sendMail($userDtls->email, $emailTitle, $emailBody);
    
      session()->flash('message', 'Letter is successfully forwarded!');
      $this->reset(['workflow']);
      $this->confirmItemAdd = false;
      $this->showactivity = false;
      $this->writecomment = false;
      $this->forward = false;
    }

    public function editWorkflow(Workflow $workflow)
    {
      Utilities::updateNotification(decryptInteger($workflow->id));
      $this->workflow = $workflow;
      $this->writecomment = false;
      $this->confirmItemAdd = false;
      $this->showactivity = false;
      $this->edit = true;
    }

     /**
     * display activity logs
     */
    public function showActivity($id)
    {
      Utilities::updateNotification($id);
      $this->activityLogs = Notification::with('user')->with('forwardto')->where('fid',$id)->where('route','like','%workflow%')->orderBy('created_at','desc')->get();
      $this->confirmItemAdd = false;
      $this->showactivity = true;
    }
  
    /**
     * write comment
     */
    public function writeComment(Workflow $workflow)
    {
      $this->workflow = $workflow;
      $this->writecomment = true;
      $this->confirmItemAdd = false;
      $this->showactivity = false;
    }

    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(Workflow $workflow)
    {
      $this->workflow = $workflow;
      $this->confirmItemAdd = true;
      $this->writecomment = false;
      $this->showactivity = false;
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
     * @param  mixed $id
     * @return void
     */
    public function destroy(Workflow $workflow)
    {
      $workflow->delete();
      $this->confirmItemDeletion = false;
      session()->flash('message', 'Letter deleted successfully.');
      $this->reset(['workflow']);
      return redirect()->back();
    }
  
    /**
     * close  modal and reset the form 
     */
    public function closeModal()
    {
      $this->confirmItemAdd = false;
      $this->showactivity = false;
      $this->forward = false;
      $this->writecomment = false;
      $this->edit = false;
      $this->reset(['workflow']);
    }

  public function updatedDivisionId($divID)
  {
    $this->staffLists = User::where("division_id", $divID)->get();
  }
  
}
