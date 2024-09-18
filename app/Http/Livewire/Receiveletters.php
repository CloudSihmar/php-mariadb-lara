<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Admin\Agency;
use App\Models\Admin\Department;
use App\Models\Admin\Division;
use App\Models\Receiveletter;
use Livewire\WithFileUploads;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use App\Traits\IDGeneratorTrait;
use App\Models\Filemanager;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Fileindex;
use App\Models\User;
use Livewire\WithPagination;


class Receiveletters extends Component
{
  use WithPagination;
  use WithFileUploads;
  use IDGeneratorTrait;

    public $docID;
    public $receiveletter;
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
    public $dakNumber;
    public $to_department_id;
    public $from_department;
    public $to_division_id;
    public $to_agency_id;
    public $from_division;
    public $dak_number;
    
    public $from_agency;
    public $receive_date;
    public $to_adressed;
    public $to_subject;
    
    public $file_index;
    public $fileindexes;

    public $from_department_id;
    public $from_division_id;
    public $usersLists;

    public $fileIndexs;

    public $receiveEdit;
    /**
     * mount
     * @param  mixed $id
     * @return void
     */
    public function mount(){
      $this->activityLogs = collect();
      $this->attachmentFiles = collect();
      $this->usersLists = collect();
      $this->divisions = collect();
      $this->fileindexes = collect();

      if (auth()->user()->can('receive.letter')) {
        $this->agencies = Agency::orderBy('name','asc')->get();
        $this->departments = Department::orderBy('name','asc')->get();
        $this->fileIndexs = Fileindex::orderBy('name','asc')->get();
        $this->divisions = Division::orderBy('name','asc')->get();
      }else{
        abort(401);
      }
    
    }

    /**
     * Render page
     *
     * @return void
     */
    public function render($id = null)
    {
      if (isset($this->receiveletter->id)) {
        $this->docID =$this->receiveletter->doc_id;
      }else{
            if ($id) { //edit
              $this->docID = $id;
            } 
            else { //create new letter
              $this->docID = $this->IDGeneratorDR(new Receiveletter(), 'dak_number','RL', 5);
              // $this->docID = $this->IDGenerator(new Receiveletter, 'doc_id', 'RL', 5); 
              // $this->dakNumber =  str_replace("L","N",$this->docID);
              // $this->dak_number =  $this->dakNumber;
            }
      }
      $receiveletters_user = Receiveletter::where('author',Auth::user()->id)->orderBy('id', 'desc');
      $receiveletters = DB::table('receiveletters')
                        ->leftjoin('notifications', 'receiveletters.id', '=', 'notifications.fid')
                        ->where('notifications.forward_to','=',Auth::user()->id)
                        ->select('receiveletters.*')
                        ->union($receiveletters_user)->orderBy('id', 'desc')
                        ->paginate(20);
      return view('livewire.receiveletters.index', compact('receiveletters'))->layout(getLayout());
    }
  
      /**
       * updatedSearchTerm
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

      function setValue($name)
      {
        $this->file_index = $name;
        $this->fileindexes = collect();
      }


    /**
     * store  data
     *
     * @return void
     */
  
    public function store()
    {
      if (isset($this->receiveletter->id)) {
        $this->saveRecord($this->receiveletter->id);
      } else {
        
          Receiveletter::create([
            'doc_id' => $this->docID,
            'from_agency'      => $this->from_agency,
            'from_department'  => $this->from_department,
            'from_division'    => $this->from_division,
            'dak_number'      => $this->dak_number,
            'receive_date'        => $this->receive_date,
            'to_adressed'         => $this->to_adressed,
            'to_agency_id'        => 1,
            'to_department_id'     => $this->to_department_id,
            'to_division_id'       => $this->to_division_id,
            'to_subject'        => $this->to_subject,
            'file_index'  => $this->file_index,
            'author' => Auth::user()->id
          ]);
          session()->flash('message', 'Letter successfully received. Now Forward it...!');
      }
      $this->clearFields();

      $this->confirmItemAdd = false;
      $this->showactivity = false;
      $this->viewfiles = false;
      $this->writecomment = false;
      $this->forward = false;
      return redirect()->route('app.receiveletter.applications');
    }
  
    public function saveRecord($receiveletterid)
    {
      $result = Receiveletter::find($receiveletterid);
      $result->from_agency = $this->from_agency;
      $result->from_department = $this->from_department;
      $result->from_division = $this->from_division;
      $result->receive_date = $this->receive_date;
      $result->to_adressed = $this->to_adressed;
      $result->to_agency_id = $this->to_agency_id;
      $result->to_department_id = $this->to_department_id;
      $result->to_division_id = $this->to_division_id;
      $result->to_subject = $this->to_subject;
      $result->file_index = $this->file_index;
      $result->author = Auth::user()->id;
      $result->save();
      session()->flash('message', 'Letter successfully updated!');
    }

    public function clearFields()
    {
      $this->from_agency = null;
      $this->from_department = null;
      $this->from_division = null;
      $this->receive_date = null;
      $this->to_adressed = null;
      $this->to_agency_id = null;
      $this->to_department_id = null;
      $this->to_division_id = null;
      $this->to_subject = null;
      $this->file_index = null;
      $this->docID = null;
      $this->dak_number = null;
    }
  
     /**
     * store user comments
     *
     * @return void
     */
    public function savecomment(Receiveletter $receiveletter)
    {
      $this->validate([
        'comment' => 'required',
      ],[
        'comment.required' => 'Comment cannot be blank',
      ]);

     Utilities::sendNotification($this->receiveletter->id,Auth::user()->id,$this->comment, 'receiveletter');
     session()->flash('message', 'Your comment is successfully saved!');

     $this->clearFields();
     $this->reset(['remarks']);
     $this->reset(['comment']);

     $this->confirmItemAdd = false;
     $this->showactivity = false;
     $this->writecomment = false;
     $this->forward = false;
     $this->viewfiles = false;

     return redirect()->route('app.receiveletter.applications');
    }

     /**
     * forward window popup
     *
     * @return void
     */
    public function forwardModal(Receiveletter $receiveletter)
    {
      $this->receiveletter = $receiveletter;
      $this->confirmItemAdd = false;
      $this->showactivity = false;
      $this->forward = true;
      $this->viewfiles = false;
      $this->writecomment = false;
    }

   /**
     * forward letter
     *
     * @return void
     */
    public function forwardTo()
    {
      $this->validate([
        'remarks' => 'required',
      ],[
        'remarks.required' => 'Please provide your remarks',
      ]);
     
      Utilities::sendNotification($this->receiveletter->id,$this->user,$this->remarks, 'receiveletter');
    
      $userDtls = User::find($this->user);
      $emailTitle = 'Receive Letter Notification';
      $emailBody = 'Dear '.$userDtls->name.',Your have received letter to take action.'.$this->remarks;
      // Utilities::sendMail($userDtls->email, $emailTitle, $emailBody);

      session()->flash('message', 'Letter is successfully forwarded!');
     
      $this->clearFields();

      $this->confirmItemAdd = false;
      $this->showactivity = false;
      $this->writecomment = false;
      $this->forward = false;
      $this->viewfiles = false;

      return redirect()->route('app.receiveletter.applications');
    }
    
     /**
     * display activity logs
     */
    public function showActivity($id)
    {
      Utilities::updateNotification($id);
      $this->activityLogs = Notification::with('user')->with('forwardto')->where('fid',$id)->where('route','like','%receiveletter%')->orderBy('created_at','desc')->get();
      $this->confirmItemAdd = false;
      $this->showactivity = true;
      $this->viewfiles = false;
    }
  
     /**
     * display activity logs
     */
    public function viewFiles($id)
    {
      Utilities::updateNotification($id);
      $receiveletterList = Receiveletter::find($id);
      $this->attachmentFiles = Filemanager::where('doc_id','=',$receiveletterList->doc_id)->get();
      $this->viewfiles = true;
      $this->confirmItemAdd = false;
      $this->showactivity = false;
    }

    /**
     * write comment
     */
    
    public function writeComment(Receiveletter $receiveletter)
    {
      $this->receiveletter = $receiveletter;
      $this->writecomment = true;
      $this->confirmItemAdd = false;
      $this->showactivity = false;
      $this->viewfiles = false;
    }
  

    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(Receiveletter $receiveletter)
    {
      $this->receiveletter = $receiveletter;

      $this->from_agency = $this->receiveletter->from_agency;
      $this->from_department = $this->receiveletter->from_department;
      $this->from_division = $this->receiveletter->from_division;
      $this->to_department_id = $this->receiveletter->to_department_id;
      $this->to_division_id = $this->receiveletter->to_division_id;
      $this->receive_date = $this->receiveletter->receive_date;
      $this->to_adressed = $this->receiveletter->to_adressed;
      $this->to_agency_id = $this->receiveletter->to_agency_id;
      $this->to_subject = $this->receiveletter->to_subject;
      $this->file_index = $this->receiveletter->file_index;
      $this->dak_number = $this->receiveletter->dak_number;
     
      $this->confirmItemAdd = true;
      $this->writecomment = false;
      $this->showactivity = false;
      $this->viewfiles = false;

      $this->receiveEdit = true;
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
    public function destroy(Receiveletter $receiveletter)
    {
      $receiveletter->delete();
      $this->confirmItemDeletion = false;
      session()->flash('message', 'Letter deleted successfully.');
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
      session()->flash('message', 'Receive Attachment deleted successfully.');
      $this->clearFields();
     return redirect()->route('app.receiveletter.applications');
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
      $this->file_index = null;
      $this->clearFields();
      if(!empty($this->receiveletter->id))
      {
        $this->receiveletter->id = null;
      }
      $this->reset(['remarks']);
      $this->reset(['comment']);

      $this->receiveEdit = false;
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

  public function updatedToDepartmentId($depID)
  {
    $this->divisions = Division::where("department_id", $depID)->get();
  }

  public function updatedFromDepartmentId($depID)
  {
    $this->divisions = Division::where("department_id", $depID)->get();
  }

  public function updatedFromDivisionId($divID)
  {
    $this->usersLists = User::where("division_id", $divID)->get();

  }

  public function updatedToDivisionId()
  {
    if(!$this->receiveEdit){
      $this->dak_number  = Utilities::getDakNumber();
      $this->docID = $this->dak_number;
    }
  }

}

