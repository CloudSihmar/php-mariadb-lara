<?php

namespace App\Http\Livewire;

use App\Models\Admin\Joinsittingdocumentdirectory;
use Livewire\Component;
use App\Models\Admin\Parliament;
use App\Models\Admin\Parliamentsession;
use App\Models\Admin\SessiondocCategory;
use App\Models\Joinsittingdocument;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class JoinsittingdocumentArchives extends Component
{
  use WithPagination;

  public $categories;
  public $parliaments;
  public $parSessions;
  public $parliament_id;
  public $session_id;
  public $category_id;
  public $documents;
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
    $this->categories = Joinsittingdocumentdirectory::all();
    $this->parliaments = Parliament::latest()->get()->skip(1);
    $this->parSessions = collect();
    $this->documents = collect();
  }

  /**
   * render
   *
   * @return void
   */
  public function render()
  {
    $this->documents = Joinsittingdocument::where('directory_id', $this->category_id)
                      ->where('parliament_id', 'LIKE', '%' . $this->parliament_id . '%')
                      ->where('session_id', 'LIKE', '%' . $this->session_id . '%')
                      ->where('keyword', 'LIKE', '%' . $this->search_key . '%')
                      ->get();
    return view('livewire.jointsittingdocumentarchives.index')->layout(getLayout());
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
   * close  modal and reset the form 
   */
  public function closeModal()
  {
    $this->viewAudio = false;
    $this->viewVideo = false;
    $this->viewImage = false;
  }


  /**
   * download
   * @param  mixed $id
   * @return void
   */
  public function download($id)
  {
    $joinsitting = Joinsittingdocument::where('id', $id)->firstOrFail();
    $file_path = public_path('uploads/' . $joinsitting->document);
    return response()->download($file_path);
  }


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
      'category_id' => 'required',
    ], [
      'parliament_id.required' => 'Please select parliament name',
      'session_id.required' => 'Please select session name',
      'category_id.required' => 'Please select document category',
    ]);
    $this->documents = Joinsittingdocument::where('directory_id', $this->category_id)
      ->where('parliament_id', $this->parliament_id)
      ->where('session_id', $this->session_id)
      ->where('keyword', 'LIKE', '%' . $this->search_key . '%')
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
   * showAudioModal
   * @return void
   */
  public function showAudioModal($id)
  {
    $this->viewAudio = true;
    $this->view_file = Sessiondocument::where('id', $id)->first()->document;
  }

  
}
