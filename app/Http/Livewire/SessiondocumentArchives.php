<?php

namespace App\Http\Livewire;

use App\Models\Admin\Parliament;
use App\Models\Admin\Parliamentsession;
use App\Models\Admin\SessiondocCategory;
use App\Models\Admin\Sessiondocumentsubcategory;
use App\Models\Sessiondocument;
use Livewire\Component;
use Livewire\WithPagination;


class SessiondocumentArchives extends Component
{
  use WithPagination;

  public $categories;
  public $parliaments;
  public $parSessions;
  public $parliament_id;
  public $session_id;
  public $category_id;
  public $documents;
  public $subfolders;
  public $confirmItemAdd;
  public $search_key;

  public $viewAudio = false;
  public $viewVideo = false;
  public $viewImage = false;
  public $viewDoc = false;
  public $view_file; 

  public $confirmItemDeletion = false;

  /**
   * mount
   * @param  mixed $agencyID
   * @return void
   */
  public function mount()
  {
    // $this->catID = $catID;
    $this->parliaments = Parliament::latest()->get()->skip(1);
    $this->parSessions = collect(); 
    $this->categories = SessiondocCategory::all();
    $this->documents = collect();
    $this->subfolders = collect();
  }

  /**
   * render
   *
   * @return void
   */
  public function render()
  {
    $this->subfolders = Sessiondocumentsubcategory::where('parliament_id', $this->parliament_id)
      ->where('session_id', $this->session_id)
      ->where('category_id', $this->category_id)
      ->orderBy('name', 'ASC')
      ->get();

    $this->documents = Sessiondocument::where('category_id', $this->category_id)
      ->where('parliament_id', $this->parliament_id)
      ->where('session_id', $this->session_id)
      ->where('keyword', 'LIKE', '%' . $this->search_key . '%')
      ->orderBy('name', 'ASC')
      ->get();
      
    return view('livewire.sessiondocumentarchives.index')->layout(getLayout());
  }
  
  /**
   * updatedParliamentId
   * @param  mixed $par_id
   * @return void
   */
  public function updatedParliamentId($parID)
  {
    $this->parSessions = Parliamentsession::where('parliament_id', $parID)->get();
  }

  /**
   * updatedParliamentId
   * @param  mixed $par_id
   * @return void
   */
  // public function updatedSessionId($sID)
  // {
  //   $this->categories = SessiondocCategory::where('id', $sID)->get();
  // }

  /**
   * search
   * @param  mixed $id
   * @return void
   */
  public function searchArchives()
  {
      $this->validate([
        'parliament_id' => 'required',
        'session_id' => 'required',
      ],[
        'parliament_id.required' => 'Please select parliament name',
        'session_id.required' => 'Please select session name',
      ]);
    
      $this->subfolders = Sessiondocumentsubcategory::where('parliament_id', $this->parliament_id)
                                              ->where('session_id', $this->session_id)
                                              ->where('category_id', $this->category_id)
                                              ->orderBy('name', 'ASC')
                                              ->get();

      $this->documents = Sessiondocument::where('category_id', $this->category_id)
                                        ->where('parliament_id', $this->parliament_id)
                                        ->where('session_id', $this->session_id)
                                        ->where('keyword', 'LIKE', '%' . $this->search_key . '%')
                                        ->orderBy('name', 'ASC')
                                        ->get();

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
     * close  modal and reset the form 
     */
    public function closeModal()
    {
      $this->confirmItemAdd = false;
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
      $sessiondoc = Sessiondocument::where('id', $id)->firstOrFail();
      $file_path = public_path('uploads/' . $sessiondoc->document);
      return response()->download($file_path);
    }

}
