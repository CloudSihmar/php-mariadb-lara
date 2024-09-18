<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Sessiondocument;
use App\Models\Admin\Parliament;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin\SessiondocCategory;
use App\Models\Admin\Sessiondocumentsubcategory;

class Sessiondocuments extends Component
{
  use WithFileUploads;

  public $catID;
  public $sID;
  public $categories;
  public $folders;
  public $currentParliament;

  public $name;
  public $parID;
  public $keyword;
  public $session_id;
  public $document;

  public $confirmItemDeletion = false;
  public $confirmItemAdd = false;
  public $addNewFolder = false;
  public $foldername;
  public $folder;
  public $confirmFolderDeletion = false;

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
  public function mount($sID, $catID)
  {
    if(auth()->user()->can('session.documents')) {
      $this->sID = $sID;
      $this->catID = $catID;
      $this->categories = SessiondocCategory::all();
      $this->currentParliament = Parliament::latest()->first();
      $this->parID = $this->currentParliament->id;
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
    $documents = Sessiondocument::where('category_id', $this->catID)
                                ->where('session_id', $this->sID)
                                ->orderBy('name', 'ASC')
                                ->paginate(20);
    $selectedCat = SessiondocCategory::where('id', $this->catID)->first();

    $subfolders = Sessiondocumentsubcategory::where('parliament_id', $this->parID)->where('category_id', $this->catID)->where('session_id', $this->sID)->get();
    return view('livewire.sessiondocuments.index', compact('documents', 'selectedCat', 'subfolders'))->layout(getLayout());
  }

  /**
   * store  data
   * @return void
   */
  public function store()
  {
    $this->validate();
    $filepath = $this->document->storeAs('SessionDocument', time() . '.' . $this->document->extension(), 'uploads');
    Sessiondocument::create([
      'category_id' => $this->catID,
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
    $this->view_file = Sessiondocument::where('id', $id)->first()->document;
  }

    
  /**
   * showVideoModal
   * @return void
   */
  public function showVideoModal($id)
  {
    $this->viewVideo = true;
    $this->view_file = Sessiondocument::where('id', $id)->first()->document;

  }

  /**
   * showImageModal
   * @return void
   */
  public function showImageModal($id)
  {
    $this->viewImage = true;
    $this->view_file = Sessiondocument::where('id', $id)->first()->document;
  }


  /**
   * showDocModal
   * @return void
   */
  public function showDocModal($id)
  {
    $this->viewDoc = true;
    $this->view_file = Sessiondocument::where('id', $id)->first()->document;
  }


  /**
   * Delete  item
   * @param  mixed $id
   * @return void
   */
  public function destroy(Sessiondocument $sessiondoc)
  {
    $sessiondoc->delete();
    Storage::disk('uploads')->delete($sessiondoc->document);
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
    $this->confirmFolderDeletion = false;
    $this->reset(['name', 'keyword', 'document','foldername']);
  }

    
  /**
   * download
   * @param  mixed $id
   * @return void
   */
  public function download($id)
  {
    $sessiondoc = Sessiondocument::where('id', $id)->firstOrFail();
    $file_path = public_path('uploads/' . $sessiondoc->document);
    return response()->download($file_path);
  }


  /**
   * showEditFolder
   * @return void
   */
  public function showEditFolder($id)
  {
    $this->folder = SessiondocumentSubCategory::find($id);
    $this->foldername = $this->folder->name;
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
    $this->folder = SessiondocumentSubCategory::find($id);
    $this->confirmFolderDeletion = true;
  }
  


  /**
   * store  data
   * @return void
   */
  public function newfolder()
  {
    if (isset($this->folder->id)) {
      $this->folder->name = $this->foldername;
      $this->folder->save();
    } else {
      SessiondocumentSubCategory::create([
      'category_id' => $this->catID,
      'parliament_id' => $this->parID,
      'session_id' => $this->sID,
      'name' =>   $this->foldername
    ]);
    }
    $this->addNewFolder = false;
    $this->reset(['foldername', 'folder']);
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
    return redirect()->back();
  }
}
