<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Admin\Joinsittingdocumentdirectory;
use App\Models\Admin\Jointsittingdocumentsubdirectory;
use App\Models\Jointsittingsubdocument;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin\Parliament;

class JointsittingSubdocuments extends Component
{
  use WithFileUploads;

  public $sID;
  public $dirID;
  public $subdirID;
  public $parID;
  public $currentParliament;
  public $categories;
  public $name;
  public $keyword;
  public $session_category_id;
  public $session_id;
  public $document;

  public $confirmItemDeletion = false;
  public $confirmItemAdd = false;
  public $viewAudio = false;
  public $viewVideo = false;
  public $viewImage = false;
  public $viewDoc = false;
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
  public function mount($sID, $dirID, $subdirID)
  {
    if (auth()->user()->can('session.documents')) {
      $this->sID = $sID;
      $this->dirID = $dirID;
      $this->subdirID = $subdirID;
      $this->categories = Joinsittingdocumentdirectory::all();
      $this->currentParliament = Parliament::latest()->first();
      $this->parID = $this->currentParliament->id;
    } else {
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
    $documents = Jointsittingsubdocument::where('directory_id', $this->dirID)
                                  ->where('sub_directory_id', $this->subdirID)
                                  ->where('parliament_id', $this->parID)
                                  ->where('session_id', $this->sID)
                                  ->paginate(20);
    $selectedCat = Joinsittingdocumentdirectory::where('id', $this->dirID)->first();
    $selectedSubFolder = Jointsittingdocumentsubdirectory::where('id', $this->subdirID)->first();
    return view('livewire.jointsittingsubdocuments.index', compact('documents', 'selectedCat', 'selectedSubFolder'))->layout(getLayout());
  }

  /**
   * store  data
   * @return void
   */
  public function store()
  {
    $this->validate();
    $filepath = $this->document->storeAs('session-subfolders', time() . '.' . $this->document->extension(), 'uploads');
    Jointsittingsubdocument::create([
      'directory_id' => $this->dirID,
      'sub_directory_id' => $this->subdirID,
      'parliament_id' => $this->parID,
      'session_id' =>   $this->sID,
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
   * showAudioModal
   * @return void
   */
  public function showAudioModal($id)
  {
    $this->viewAudio = true;
    $this->view_file = Jointsittingsubdocument::where('id', $id)->first()->document;
  }

  /**
   * showVideoModal
   * @return void
   */
  public function showVideoModal($id)
  {
    $this->viewVideo = true;
    $this->view_file = Jointsittingsubdocument::where('id', $id)->first()->document;
  }

  /**
   * showImageModal
   * @return void
   */
  public function showImageModal($id)
  {
    $this->viewImage = true;
    $this->view_file = Jointsittingsubdocument::where('id', $id)->first()->document;
  }


  /**
   * showDocModal
   * @return void
   */
  public function showDocModal($id)
  {
    $this->viewDoc = true;
    $this->view_file = Jointsittingsubdocument::where('id', $id)->first()->document;
  }


  /**
   * Delete  item
   * @param  mixed $id
   * @return void
   */
  public function destroy(Jointsittingsubdocument $subfolderdoc)
  {
    $subfolderdoc->delete();
    Storage::disk('uploads')->delete($subfolderdoc->document);
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
    $this->reset(['name', 'keyword', 'document']);
  }


  /**
   * download
   * @param  mixed $id
   * @return void
   */
  public function download($id)
  {
    $sessiondoc = Jointsittingsubdocument::where('id', $id)->firstOrFail();
    $file_path = public_path('uploads/' . $sessiondoc->document);
    return response()->download($file_path);
  }
}
