<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Admin\SessiondocCategory;
use App\Models\Admin\Sessiondocumentsubcategory;
use App\Models\Sessiondocumentsubfolder;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin\Parliament;

class Sessiondocumentsubfolders extends Component
{
  use WithFileUploads;

  public $sID;
  public $catID;
  public $subCatID;
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
  public function mount($sID, $catID, $subCatID)
  {
    if (auth()->user()->can('session.documents')) {
      $this->sID = $sID;
      $this->catID = $catID;
      $this->subCatID = $subCatID;
      $this->categories = SessiondocCategory::all();
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
    $documents = Sessiondocumentsubfolder::where('category_id', $this->catID)
                                          ->where('sub_category_id', $this->subCatID)
                                          ->where('parliament_id', $this->parID)
                                          ->where('session_id', $this->sID)
                                          ->orderBy('name', 'ASC')
                                          ->get();
    $selectedCat = SessiondocCategory::where('id', $this->catID)->first();
    $selectedSubFolder = Sessiondocumentsubcategory::where('id', $this->subCatID)->first();
    return view('livewire.sessiondocumentsubfolder.index', compact('documents', 'selectedCat', 'selectedSubFolder'))->layout(getLayout());
  }

  /**
   * store  data
   * @return void
   */
  public function store()
  {
    $this->validate();
    $filepath = $this->document->storeAs('session-subfolders', time() . '.' . $this->document->extension(), 'uploads');
    Sessiondocumentsubfolder::create([
      'parliament_id' => $this->parID,
      'session_id' =>   $this->sID,
      'category_id' => $this->catID,
      'sub_category_id' => $this->subCatID,
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
    $this->view_file = Sessiondocumentsubfolder::where('id', $id)->first()->document;
  }

  /**
   * showVideoModal
   * @return void
   */
  public function showVideoModal($id)
  {
    $this->viewVideo = true;
    $this->view_file = Sessiondocumentsubfolder::where('id', $id)->first()->document;
  }

  /**
   * showImageModal
   * @return void
   */
  public function showImageModal($id)
  {
    $this->viewImage = true;
    $this->view_file = Sessiondocumentsubfolder::where('id', $id)->first()->document;
  }


  /**
   * showDocModal
   * @return void
   */
  public function showDocModal($id)
  {
    $this->viewDoc = true;
    $this->view_file = Sessiondocumentsubfolder::where('id', $id)->first()->document;
  }


  /**
   * Delete  item
   * @param  mixed $id
   * @return void
   */
  public function destroy(Sessiondocumentsubfolder $subfolderdoc)
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
    $sessiondoc = Sessiondocumentsubfolder::where('id', $id)->firstOrFail();
    $file_path = public_path('uploads/' . $sessiondoc->document);
    return response()->download($file_path);
  }
}
