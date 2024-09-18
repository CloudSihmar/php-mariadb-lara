<?php

namespace App\Http\Livewire;

use App\Models\Admin\Committee;
use App\Models\Admin\Committeedoctype;
use App\Models\Admin\Committeemember;
use App\Models\Admin\Parliament;
use App\Models\Admin\Committeesubfolder;
use App\Models\Committeedocument;
use App\Models\Committeesubfolderdocument;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Traits\RolesPermissionsTrait;


class Committeesubdocuments extends Component
{
    use WithFileUploads;
    use RolesPermissionsTrait;

    public $parID;
    public $committees;
    public $comID;   //committee id
    public $subdirID;   //sub folder id
    public $IsMember;
    public $selectedCommittee;
    public $selectedCategory;
    public $selectedFolder;
    public $name;
    public $keyword;
    public $document;
    public $documents;
    public $viewDoc = false;
    public $view_file;

    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;

    protected $rules = [
    'name' => 'required',
    'keyword' => 'nullable',
    'document' => 'nullable' 
    ];
    /**
   * mount
   * @param  mixed $agencyID
   * @return void
   */
    public function mount($parID, $comID, $subdirID)
    {
        $this->parID = $parID;
        $this->comID = $comID;
        $this->subdirID = $subdirID;

        if (auth()->user()->hasAnyRole('admin')) {
          $this->committees = Committee::where('parliament_id', $this->parID)->get();
          $this->selectedCommittee = Committee::first();
          $this->IsMember = true;
        }else{
          $committee_ids = Committeemember::where('user_id', auth()->user()->id)->pluck('committee_id');
          if ($committee_ids->isEmpty()) {
            $this->committees = collect();
            $this->documents = collect();
            $this->IsMember = false;
            session()->flash('message', 'You are not a member of any committees');
          } else {
            $this->IsMember = true;
            $this->committees =  Committee::whereIn('id', $committee_ids)->get();
            $this->selectedCommittee = Committee::where('id', $this->comID)->first();
            $this->documents = Committeedocument::where('committee_id', $this->comID)->get();
          }
      }
    }

    /**
     * render
     *
     * @return void
     */
    public function render()
    {
        $this->selectedCommittee =  Committee::where('id', $this->comID)->first();
        $this->selectedFolder =  Committeesubfolder::where('id', $this->subdirID)->first();
        $this->documents = Committeesubfolderdocument::where('sub_folder_id', $this->subdirID)
                                            ->where('committee_id', $this->comID)
                                            ->where('parliament_id', $this->parID)
                                            ->orderBy('id', 'DESC')
                                            ->get();
        return view('livewire.committeesubfolderdocuments.index')->layout(getLayout());
        
    }
    /**
     * store  data
     * @return void
     */
      public function store()
      {
        $this->validate();
        $foldername = 'CommitteeDocument/' . $this->name;
        $filepath = $this->document->storeAs($foldername, time() . '.' . $this->document->extension(), 'uploads');
        Committeesubfolderdocument::create([
          'parliament_id' => $this->parID,
          'committee_id' => $this->comID,
          'sub_folder_id' => $this->subdirID,
          'name' =>   $this->name,
          'keyword' =>   $this->keyword,
          'document' =>  $filepath,
          'extension' =>  $this->document->extension(),
        ]);

        $this->confirmItemAdd = false;
        $this->reset(['name', 'keyword', 'document']);
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
    public function destroy(Committeesubfolderdocument $committeedoc)
    {
      $committeedoc->delete();
      Storage::disk('uploads')->delete($committeedoc->document);
      $this->confirmItemDeletion = false;
      session()->flash('message', 'Document deleted successfully.');
    }

    /**
     * showDocModal
     * @return void
     */
    public function showDocModal($id)
    {
      $this->viewDoc = true;
      $this->view_file = Committeesubfolderdocument::where('id', $id)->first()->document;
    }

    /**
     * close  modal and reset the form 
     */
    public function closeModal()
    {
      $this->confirmItemAdd = false;
      $this->viewDoc = false;
      $this->reset(['name', 'keyword', 'document']);
    }

    /**
     * download
     * @param  mixed $id
     * @return void
     */
    public function download($id)
    {
      $committeedoc = Committeesubfolderdocument::where('id', $id)->firstOrFail();
      $file_path = public_path('uploads/' . $committeedoc->document);
      return response()->download($file_path);
    }

    
    /**
     * memberProfile
     * @param  mixed $id
     * @return void
     */
    public function memberProfile($committeeID){
      $members = Committeemember::where('committee_id',$committeeID)->get();
      $committes = Committee::all();
      $selcommittee = Committee::where('id', $committeeID)->first();
      return view('livewire.committeesubfolderdocuments.committee-profile', compact('members', 'committes', 'selcommittee'))->layout(getLayout());
    }
    
  }