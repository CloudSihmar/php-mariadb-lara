<?php

namespace App\Http\Livewire;

use App\Models\Admin\Joinsittingdocumentdirectory;
use App\Models\Admin\Jointsittingdocumentsubdirectory;
use Livewire\Component;
use App\Models\Admin\Parliament;
use App\Models\Joinsittingdocument;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class Joinsittingdocuments extends Component
{
  use WithFileUploads;

  public $sID;
  public $dirID;
  public $categories;
  public $currentParliament;

  public $name;
  public $parID;
  public $keyword;
  public $session_id;
  public $document;

  public $confirmItemDeletion = false;
  public $confirmItemAdd = false;
  public $viewAudio = false;
  public $viewVideo = false;
  public $viewImage = false;
  public $viewDoc = false;
  public $addNewFolder = false;
  public $foldername;
  public $view_file; 

  protected $rules = [
    'name' => 'required',
    'keyword' => 'nullable',
    'document' => 'nullable' //'file|mimes:jpeg,png,jpg,pdf,doc,docx,xls,xlsx,mp4,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv'
  ];
  /**
   * mount
   * @param  mixed $agencyID
   * @return void
   */
  public function mount($sID, $dirID)
  {
    $this->sID = $sID;
    $this->dirID = $dirID;
    $this->categories = Joinsittingdocumentdirectory::all();
    $this->currentParliament = Parliament::latest()->first();
    $this->parID = $this->currentParliament->id;
  }

  /**
   * render
   *
   * @return void
   */
  public function render()
  {
    $documents = Joinsittingdocument::where('directory_id', $this->dirID)
                                    ->where('parliament_id', $this->parID)
                                    ->where('session_id', $this->sID)
                                    ->paginate(20);
    $selectedCat = Joinsittingdocumentdirectory::where('id', $this->dirID)->first();
    $subfolders = Jointsittingdocumentsubdirectory::where('parliament_id', $this->parID)->where('directory_id', $this->dirID)->where('session_id', $this->sID)->get();
    return view('livewire.joinsittingdocuments.index', compact('documents', 'selectedCat', 'subfolders'))->layout(getLayout());
  }

  /**
   * store  data
   * @return void
   */
  public function store()
  {
    $this->validate();
    $filepath = $this->document->storeAs('JoinsittingDocument', time() . '.' . $this->document->extension(), 'uploads');
    Joinsittingdocument::create([
      'directory_id' => $this->dirID,
      'parliament_id' => $this->parID,
      'name' =>   $this->name,
      'keyword' =>   $this->keyword,
      'session_id' =>   $this->sID,
      'document' =>  $filepath,
      'extension' =>  $this->document->extension(),
    ]);


    $this->confirmItemAdd = false;
    $this->reset(['name', 'keyword', 'document']);
  }


  /**
   * showAudioModal
   * @return void
   */
  public function showAudioModal($id)
  {
    $this->viewAudio = true;
    $this->view_file = Joinsittingdocument::where('id', $id)->first()->document;
  }


  /**
   * showVideoModal
   * @return void
   */
  public function showVideoModal($id)
  {
    $this->viewVideo = true;
    $this->view_file = Joinsittingdocument::where('id', $id)->first()->document;
  }

  /**
   * showImageModal
   * @return void
   */
  public function showImageModal($id)
  {
    $this->viewImage = true;
    $this->view_file = Joinsittingdocument::where('id', $id)->first()->document;
  }


  /**
   * showDocModal
   * @return void
   */
  public function showDocModal($id)
  {
    $this->viewDoc = true;
    $this->view_file = Joinsittingdocument::where('id', $id)->first()->document;
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
    public function destroy(Joinsittingdocument $joinsitting)
    {
      $joinsitting->delete();
      Storage::disk('uploads')->delete($joinsitting->document);
      $this->confirmItemDeletion = false;
      session()->flash('message', 'Document deleted successfully.');
    }

    /**
     * close  modal and reset the form 
     */
    public function closeModal()
    {
      $this->confirmItemAdd = false;
      $this->viewAudio = false;
      $this->viewVideo = false;
      $this->viewImage = false;
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
      $sessiondoc = Joinsittingdocument::where('id', $id)->firstOrFail();
      $file_path = public_path('uploads/' . $sessiondoc->document);
      return response()->download($file_path);
    }


  /**
   * showDocModal
   * @return void
   */
  public function showAddFolder()
  {
    $this->addNewFolder = true;
  }


  /**
   * store  data
   * @return void
   */
  public function newfolder()
  {
    Jointsittingdocumentsubdirectory::create([
      'parliament_id' => $this->parID,
      'session_id' => $this->sID,
      'directory_id' => $this->dirID,
      'name' =>   $this->foldername
    ]);
    $this->addNewFolder = false;
  }

}
