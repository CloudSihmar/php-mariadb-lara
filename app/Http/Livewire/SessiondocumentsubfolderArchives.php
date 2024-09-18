<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Admin\Parliament;
use App\Models\Admin\Parliamentsession;
use App\Models\Admin\SessiondocCategory;
use App\Models\Admin\Sessiondocumentsubcategory;
use App\Models\Sessiondocumentsubfolder;
use Livewire\WithPagination;

class SessiondocumentsubfolderArchives extends Component
{

  public $parID;
  public $sID;
  public $catID;
  public $subCatID;
  public $categories;
  public $subfolders;
  public $confirmItemAdd;
  public $search_key;

  public $viewAudio = false;
  public $viewVideo = false;
  public $viewImage = false;
  public $viewDoc = false;
  public $view_file; 

  /**
   * mount
   * @param  mixed $agencyID
   * @return void
   */
  public function mount($parID, $sID, $catID, $subCatID)
  {

    $this->parID = $parID;
    $this->sID = $sID;
    $this->catID = $catID;
    $this->subCatID = $subCatID;
    $this->categories = SessiondocCategory::all();
    $this->subfolders = collect();
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
    return view('livewire.sessiondocumentsubfolderarchives.index', compact('selectedCat', 'selectedSubFolder', 'documents'))->layout(getLayout());
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
   * close  modal and reset the form 
   */
  public function closeModal()
  {
    $this->viewAudio = false;
    $this->viewVideo = false;
    $this->viewImage = false;
    $this->viewDoc = false;
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
