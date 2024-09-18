<?php

namespace App\Http\Livewire;

use File;
use App\Models\User;
use Livewire\Component;
use App\Models\Filemanager;
use App\Models\Admin\Agency;
use App\Models\Notification;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Admin\Division;
use App\Models\Dispatchletter;
use App\Models\Admin\Fileindex;

use App\Models\Admin\Department;
use App\Traits\IDGeneratorTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\DispatchReceiveNumber;
use App\Traits\DispatchNumberGeneratorTrait;

class Dispatchletters extends Component
{
  use WithPagination;
    use IDGeneratorTrait;
    use DispatchNumberGeneratorTrait;
      
    use WithFileUploads;

    public $docID;
    public $dispatchletter;
    public $agencies;
    public $departments;
    public $divisions;
    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;
    public $forward = false;
    public $showactivity = false;
    public $viewfiles = false;
    public $activityLogs;
    public $writecomment;
    public $remarks;
    public $user;
    public $comment;
    public $attachmentFiles;
    public $to_department;
    public $to_division;
    public $file_index;
    public $fileindexes;
    public $division_id;
    public $from_department_id;
    public $from_division_id;
    public $issue_date;
    public $to_adressed;
    public $to_agency;
    public $to_subject;
    public $dispatch_number;
   
    public $usersLists;
    public $forward_from_department_id;
    public $forward_from_division_id;
    public $fileIndexs;

    public $dispatchEdit;
    
    /**
     * mount page
     *
     * @return void
     */
    public function mount(){
      $this->activityLogs = collect();
      $this->attachmentFiles = collect();
      $this->divisions = collect();
      $this->fileindexes = collect();
      $this->usersLists = collect();
     
      if (auth()->user()->can('dispatch.letter')) {
        $this->agencies = Agency::orderBy('name','asc')->get();
        $this->departments = Department::orderBy('name','asc')->get();
        $this->fileIndexs = Fileindex::orderBy('name','asc')->get();
        $this->divisions = Division::orderBy('name','asc')->get();

        // $this->dispatch_number  = Utilities::getDispatchNumber();
        // $this->docID = $this->dispatch_number;
      }else{
        abort(401);
      }

    }

    /**
     * Render page
     *
     * @return void
     */
    public function render($id=null)
    {
      if (isset($this->dispatchletter->id)) {
        $this->docID =$this->dispatchletter->doc_id;
      }
      else{
            if ($id) { //edit
              $this->docID = $id;
            } 
            else { //create new letter
              $this->docID = $this->IDGeneratorDR(new Dispatchletter(), 'dispatch_number','DL', 5);
              // $this->docID = $this->IDGenerator(new Dispatchletter(), 'doc_id', 'DL', 5);
              // $dispatchNumber =  str_replace("L","N",$this->docID);
              // $this->dispatch_number =  $dispatchNumber;
            }
       }
      $perPage = 25;
  
      $dispatchletters_user = Dispatchletter::where('author',Auth::user()->id)->orderBy('id', 'desc');
      $dispatchletters = DB::table('dispatchletters')
                        ->leftjoin('notifications', 'dispatchletters.id', '=', 'notifications.fid')
                        ->where('notifications.forward_to','=',Auth::user()->id)
                        ->select('dispatchletters.*')
                        ->union($dispatchletters_user)->orderBy('id', 'desc')
                        ->take(25)
                        ->paginate($perPage);
      return view('livewire.dispatchletters.index', compact('dispatchletters'))->layout(getLayout());
    }

    /**
       * updatedFileIndex
       *
       * @return void
       */
      function updatedFileIndex()
      {
        if(!$this->file_index=='')
          $this->fileindexes = Fileindex::where('name', 'LIKE', '%' . $this->file_index . '%')->get();
        else
          $this->fileindexes = collect();
      }
            
      /**
       * setValue
       *
       * @param  mixed $name
       * @return void
       */
      function setValue($name)
        {
          $this->file_index = $name;
          $this->fileindexes = collect();
        }

    /**
     * store page
     *
     * @return void
     */
    public function store()
    {
      if (isset($this->dispatchletter->id)) {
        $this->saveRecord($this->dispatchletter->id);
      } else {
          Dispatchletter::create([
            'doc_id' =>   $this->docID, 
            'from_agency_id'      => 1,
            'from_department_id'  => $this->from_department_id,
            'from_division_id'    => $this->from_division_id,
            'dispatch_number'     => $this->dispatch_number,
            'issue_date'          => $this->issue_date,
            'to_adressed'         => $this->to_adressed,
            'to_agency'           => $this->to_agency,
            'to_department'       => $this->to_department,
            'to_division'        => $this->to_division,
            'to_subject'        => $this->to_subject,
            'file_index'  => $this->file_index, 
            'author' => Auth::user()->id
          ]);
          session()->flash('message', 'Dispatch Letter created. Now Forward it...!');
      }
      $this->clearFields();

      $this->confirmItemAdd = false;
      $this->showactivity = false;
      $this->viewfiles = false;
      return redirect()->route('app.displatchletter.applications');
    }

    public function saveRecord($dispatchletterid)
    {
      $result = Dispatchletter::find($dispatchletterid);
      $result->from_department_id = $this->from_department_id;
      $result->from_division_id = $this->from_division_id;
      $result->issue_date = $this->issue_date;
      $result->to_adressed = $this->to_adressed;
      $result->to_agency = $this->to_agency;
      $result->file_index = $this->file_index;
      $result->to_department = $this->to_department;
      $result->to_division = $this->to_division;
      $result->to_subject = $this->to_subject;
      $result->file_index = $this->file_index;
      $result->author = Auth::user()->id;
      $result->save();
      session()->flash('message', 'Dispatch Letter updated!');
    }

    public function clearFields()
    {
      $this->from_department_id = null;
      $this->from_division_id = null;
      $this->issue_date = null;
      $this->to_adressed = null;
      $this->to_agency = null;
      $this->file_index = null;
      $this->to_department = null;
      $this->to_division = null;
      $this->to_subject = null;
      $this->file_index = null;
      $this->docID = null;
      $this->dispatch_number = null;
    }
  
     /**
     * store user comments
     *
     * @return void
     */
    public function savecomment(Dispatchletter $dispatchletter)
    {
      $this->validate([
        'comment' => 'required',
      ],[
        'comment.required' => 'Comment cannot be blank',
      ]);

     Utilities::sendNotification($this->dispatchletter->id,Auth::user()->id,$this->comment, 'dispatchletter');
     session()->flash('message', 'Your comment is successfully saved!');
     
     $this->clearFields();
     $this->confirmItemAdd = false;
     $this->showactivity = false;
     $this->writecomment = false;
     $this->forward = false;
     $this->viewfiles = false;
     return redirect()->route('app.displatchletter.applications');
    }

     /**
     * forward window popup
     *
     * @return void
     */
    public function forwardModal(Dispatchletter $dispatchletter)
    {
      $this->dispatchletter = $dispatchletter;
      $this->confirmItemAdd = false;
      $this->showactivity = false;
      $this->forward = true;
      $this->viewfiles = false;
      $this->clearFields();
    }

   /**
     * forward letter
     *
     * @return void
     */
    public function forwardTo(Request $request, Dispatchletter $dispatchletter)
    {
      Utilities::sendNotification($this->dispatchletter->id,$this->user,$this->remarks, 'dispatchletter');

      $userDtls = User::find($this->user);
      $emailTitle = 'Dispatch Letter Notification';
      $emailBody = 'Dear '.$userDtls->name.', Your have received letter to take action.'.$this->remarks;
      // Utilities::sendMail($userDtls->email, $emailTitle, $emailBody);

      session()->flash('message', 'Letter is successfully forwarded!');
      $this->clearFields();
      $this->confirmItemAdd = false;
      $this->showactivity = false;
      $this->writecomment = false;
      $this->forward = false;
      $this->viewfiles = false;
      return redirect()->route('app.displatchletter.applications');
    }
    
     /**
     * display activity logs
     */
    public function showActivity($id)
    {
      Utilities::updateNotification($id);
      $this->activityLogs = Notification::where('fid',$id)->where('route','like','%dispatchletter%')->orderBy('created_at','desc')->get();
      $this->confirmItemAdd = false;
      $this->showactivity = true;
      $this->viewfiles = false;
      $this->clearFields();
    }
  
     /**
     * display activity logs
     */
    public function viewFiles($id)
    {
      $dispatchletterList = Dispatchletter::find($id);
      $this->attachmentFiles = Filemanager::where('doc_id','=',$dispatchletterList->doc_id)->get();
      $this->viewfiles = true;
      $this->confirmItemAdd = false;
      $this->showactivity = false;
      $this->clearFields();
    }

    /**
     * write comment
     */
    
    public function writeComment(Dispatchletter $dispatchletter)
    {
      $this->dispatchletter = $dispatchletter;
      $this->writecomment = true;
      $this->confirmItemAdd = false;
      $this->showactivity = false;
      $this->clearFields();
    }
  

    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(Dispatchletter $dispatchletter)
    {
      $this->dispatchletter = $dispatchletter;

      $this->from_department_id = $this->dispatchletter->from_department_id;
      $this->from_division_id = $this->dispatchletter->from_division_id;
      $this->issue_date = $this->dispatchletter->issue_date;
      $this->to_adressed = $this->dispatchletter->to_adressed;
      $this->to_agency = $this->dispatchletter->to_agency;
      $this->file_index = $this->dispatchletter->file_index;
      $this->to_department = $this->dispatchletter->to_department;
      $this->to_division = $this->dispatchletter->to_division;
      $this->to_subject = $this->dispatchletter->to_subject;
      $this->file_index = $this->dispatchletter->file_index;
      $this->dispatch_number = $this->dispatchletter->dispatch_number;
      $this->confirmItemAdd = true;
      $this->writecomment = false;
      $this->showactivity = false;

      $this->dispatchEdit = true;
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
    public function destroy(Dispatchletter $dispatchletter)
    {
      $dispatchletter->delete();
      $this->confirmItemDeletion = false;
      session()->flash('message', 'Dispatch Letter deleted successfully.');
      $this->clearFields();
      return redirect()->back();
    }
  
    /**
     * Delete  File
     *
     * @param  mixed $id
     * @return void
     */
    public function destroyFile(Filemanager $filemanager)
    {
      $filemanager->delete();
      $this->confirmItemDeletion = false;
      session()->flash('message', 'Dispatch Attachment Letter deleted successfully.');
      $this->clearFields();
      return redirect()->route('app.displatchletter.applications');
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
      $this->viewfiles = false;
      if(!empty($this->dispatchletter->id))
      {
        $this->dispatchletter->id = null;
      }
      $this->clearFields();

      $this->dispatchEdit = false;
    }

    /**
     * download
     * @param  mixed $id
     * @return void
     */
    public function download($id)
    {
      $attachmentdoc = Filemanager::where('id', $id)->firstOrFail();
      $file_path = public_path('uploads/' . $attachmentdoc->filepath);
      return response()->download($file_path);
    }

  public function updatedFromDepartmentId($depID)
  {
    $this->divisions = Division::where("department_id", $depID)->get();
  }

  public function updatedToDepartmentId($depID)
  {
    $this->divisions = Division::where("department_id", $depID)->get();
  }

  public function updatedForwardFromDepartmentId($depID)
  {
    $this->divisions = Division::where("department_id", $depID)->get();
  }

  public function updatedForwardFromDivisionId($divID)
  {
    $this->usersLists = User::where("division_id", $divID)->get();
  }

  public function updatedFromDivisionId($divID)
  {
    $this->usersLists = User::where("division_id", $divID)->get();

    if(!$this->dispatchEdit){
      $this->dispatch_number  = Utilities::getDispatchNumber();
      $this->docID = $this->dispatch_number;
    }
  }
}

