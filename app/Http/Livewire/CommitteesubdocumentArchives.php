<?php

namespace App\Http\Livewire;

use App\Models\Admin\Parliament;
use App\Models\Committeesubfolderdocument;
use App\Models\Admin\Committeesubfolder;
use Livewire\Component;
use Livewire\WithPagination;

class CommitteesubdocumentArchives extends Component
{
  use WithPagination;

  public $SelectedParliament;
  public $parID;
  public $selectedFolder;
  public $parliaments;
  public $committee_id;
  public $documents;
  public $confirmItemAdd;
  public $search_key;
  public $confirmItemDeletion = false;
  public $viewDoc = false;
  public $view_file;

  /**
   * mount
   * @param  mixed $agencyID
   * @return void
   */
  public function mount($parID, $comID, $subdirID)
  {
    $this->parID = $parID;
    $this->parliaments = Parliament::latest()->get()->skip(1);
    $this->SelectedParliament = Parliament::where('id', $parID)->first();
    $this->selectedFolder = Committeesubfolder::where('id', $subdirID)->first();
    $this->documents = Committeesubfolderdocument::where('parliament_id', $parID)
                                                  ->where('committee_id', $comID)
                                                  ->where('sub_folder_id', $subdirID)
                                                  ->get();
  }

  /**
   * render
   * @return void
   */
  public function render()
  {
    return view('livewire.committeesubfolderdocumentsarchives.index')->layout(getLayout());
  }

  /**
   * close  modal and reset the form 
   */
  public function closeModal()
  {
    $this->confirmItemAdd = false;
    $this->viewDoc = false;
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
   * showDocModal
   * @return void
   */
  public function showDocModal($id)
  {
    $this->viewDoc = true;
    $this->view_file = Committeesubfolderdocument::where('id', $id)->first()->document;
  }
 
}
