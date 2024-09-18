<?php

namespace App\Http\Livewire;

use App\Models\Admin\Committee;
use App\Models\Admin\Committeedoctype;
use App\Models\Admin\Committeemember;
use App\Models\Admin\Committeesubfolder;
use App\Models\Committeedocument;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Traits\RolesPermissionsTrait;


class Committeedocuments extends Component
{
    use WithFileUploads;
    use RolesPermissionsTrait;

    public $committees;
    public $subfolders;
    public $IsMember;
    public $selectedCommittee;
    public $name;
    public $parID;
    public $comID;
    public $keyword;
    public $document;
    public $documents;
    public $viewDoc = false;
    public $view_file;

    public $addNewFolder = false;
    public $foldername;
    public $folder;
    public $confirmFolderDeletion = false;

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
    public function mount()
    {
        $this->parID = getCurrentParliament()->id;
        $this->subfolders = collect();
        $this->documents = collect();

        if (auth()->user()->hasAnyRole('admin')) {
          $this->committees = Committee::where('parliament_id', $this->parID)->get();
          $this->selectedCommittee = Committee::where('parliament_id', $this->parID)->first();
          if(!is_null($this->selectedCommittee)){
            $this->comID = $this->selectedCommittee->id;
            $this->documents = Committeedocument::where('parliament_id', $this->parID)->where('committee_id', $this->comID)->get();
            $this->subfolders = Committeesubfolder::where('parliament_id', $this->parID)->where('committee_id', $this->comID)->get();
          }
            $this->IsMember = true;
        }else{
          $committee_ids = Committeemember::where('user_id', auth()->user()->id)->where('parliament_id', $this->parID)->pluck('committee_id');
          if ($committee_ids->isEmpty()) {
            $this->committees = collect();
            $this->IsMember = false;
            session()->flash('message', 'You are not a member of any committees');
          } else {
            $this->IsMember = true;
            $this->committees =  Committee::whereIn('id', $committee_ids)->get();
            $this->selectedCommittee = Committee::whereIn('id', $committee_ids)->where('parliament_id', $this->parID)->first();
            $this->documents = Committeedocument::where('parliament_id', $this->parID)->where('committee_id', $this->selectedCommittee->id)->get();
            $this->subfolders = Committeesubfolder::where('parliament_id', $this->parID)->where('committee_id', $this->selectedCommittee->id)->get();
            $this->comID = $this->selectedCommittee->id;
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
        return view('livewire.committeedocuments.index')->layout(getLayout());
    }

  /**
   * searchDocs
   * @return void
   */
      public function searchDocs($id)
      {
        $this->subfolders = Committeesubfolder::where('parliament_id', $this->parID)->where('committee_id', $id)->get();
        $this->selectedCommittee = Committee::where('id', $id)->where('parliament_id', $this->parID)->first();
        $this->documents = Committeedocument::where('parliament_id', $this->parID)
                            ->where('committee_id', $id)
                            ->orderBy('id', 'asc')
                            ->get();
      }
  

    /**
     * store  data
     * @return void
     */
      public function store()
      {
        $this->validate();
        $filepath = $this->document->storeAs('CommitteeDocument', time() . '.' . $this->document->extension(), 'uploads');
        Committeedocument::create([
          'committee_id' => $this->comID,
          'parliament_id' => $this->parID,
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
    public function destroy(Committeedocument $committeedoc)
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
      $this->view_file = Committeedocument::where('id', $id)->first()->document;
    }

    /**
     * close  modal and reset the form 
     */
    public function closeModal()
    {
      $this->confirmItemAdd = false;
      $this->viewDoc = false;
      $this->addNewFolder = false;
      $this->reset(['name', 'keyword', 'document']);
    }

    /**
     * download
     * @param  mixed $id
     * @return void
     */
    public function download($id)
    {
      $committeedoc = Committeedocument::where('id', $id)->firstOrFail();
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
      return view('livewire.committeedocuments.committee-profile', compact('members', 'committes', 'selcommittee'))->layout(getLayout());
    }



  /**
   * showEditFolder
   * @return void
   */
  public function showEditFolder($id)
  {
    $this->folder = Committeesubfolder::find($id);
    $this->foldername = $this->folder->foldername;
    $this->addNewFolder = true;
  }

  /**
   * showAddFolder
   * @return void
   */
  public function showAddFolder()
  {
    $this->addNewFolder = true;
  }

  /**
   * showAddFolder
   * @return void
   */
  public function showDeleteFolder($id)
  {
    $this->folder = Committeesubfolder::find($id);
    $this->confirmFolderDeletion = true;
  }



  /**
   * store  data
   * @return void
   */
  public function newfolder()
  {
    if (isset($this->folder->id)) {
      $this->folder->foldername = $this->foldername;
      $this->folder->save();
    } else {
      Committeesubfolder::create([
        'parliament_id' => $this->parID,
        'committee_id' => $this->comID,
        'foldername' =>   $this->foldername
      ]);
    }
    $this->addNewFolder = false;
    $this->reset(['foldername', 'folder']);
    return redirect()->route('app.committee.documents');
  }


  /**
   * Delete  item
   * @param  mixed $id
   * @return void
   */
  public function deleteFolder()
  {
    $this->folder->delete();
    $this->confirmFolderDeletion = false;
    $this->reset(['foldername']);
    return redirect()->route('app.committee.documents');
  }

    
  }