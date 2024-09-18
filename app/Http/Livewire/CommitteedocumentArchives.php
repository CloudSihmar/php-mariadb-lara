<?php

namespace App\Http\Livewire;

use App\Models\Admin\Committee;
use App\Models\Admin\Committeemember;
use App\Models\Admin\Parliament;
use App\Models\Admin\Committeesubfolder;
use App\Models\Committeedocument;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;

class CommitteedocumentArchives extends Component
{
  use WithPagination;
  public $parliaments;
  public $parliament_id;
  public $committees;
  public $committee_id;
  public $subfolders;
  public $documents;
  public $search_key;
  public $viewDoc = false;
  public $view_file;
 
  /**
   * mount
   * @param  mixed $agencyID
   * @return void
   */
  public function mount()
  {
    $this->parliaments = Parliament::latest()->get()->skip(1);
    $this->committees = collect();
  }

  /**
   * render
   * @return void
   */
  public function render()
  {
    $this->subfolders = Committeesubfolder::where('parliament_id', $this->parliament_id)->where('committee_id', $this->committee_id)->get();
    $this->documents = Committeedocument::where('parliament_id', $this->parliament_id)
      ->where('committee_id', $this->committee_id)
      ->where(
        'keyword',
        'LIKE',
        '%' . $this->search_key . '%'
      )->get();
    return view('livewire.committeedocumentarchives.index')->layout(getLayout());
  }


  /**
   * updatedParliamentId
   * @param  mixed $par_id
   * @return void
   */
  public function updatedParliamentId($parID)
  {
    $this->committees = Committee::where('parliament_id', $parID)->get();
  }
  /**
   * close  modal and reset the form 
   */
  public function closeModal()
  {
    $this->viewDoc = false;
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
   * search
   * @param  mixed $id
   * @return void
   */
  public function searchArchives()
  {
      $this->validate([
      'committee_id' => 'required',
      ],[
      'committee_id.required' => 'Please select committee name',
      ]);

      $this->subfolders = Committeesubfolder::where('parliament_id', $this->parliament_id)->where('committee_id', $this->committee_id)->get();
      $this->documents = Committeedocument::where('parliament_id', $this->parliament_id)
                          ->where('committee_id', $this->committee_id)
                          ->where('keyword',
                            'LIKE',
                            '%' . $this->search_key . '%'
                          )->get();
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

}
