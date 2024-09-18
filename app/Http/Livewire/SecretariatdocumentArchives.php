<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Admin\Parliament;
use App\Models\Admin\Division;
use App\Models\Admin\Fileindex;
use App\Models\Secretariatdocument;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class SecretariatdocumentArchives extends Component
{
  use WithPagination;

  public $parliaments;
  public $parliament_id;
  public $divisions;
  public $division_id;
  public $file_index;
  public $fileindexes;
  public $documents;
  public $confirmItemAdd;
  public $search_key;
  public $from_date;
  public $end_date;
  public $viewDoc = false;
  public $view_file;

  public $confirmItemDeletion = false;

  /**
   * mount
   * @param  mixed $agencyID
   * @return void
   */
  public function mount($catID)
  {
    $this->parliaments = Parliament::latest()->get()->skip(1);
    $this->division_id = auth()->user()->division_id;
    $this->divisions = Division::all();
    $this->documents = Secretariatdocument::where('division_id', $this->division_id)
                                          ->take(5)->get();
  }

  /**
   * render
   *
   * @return void
   */
  public function render()
  {
    $this->fileindexes = Fileindex::all();
    $this->documents = Secretariatdocument::where('parliament_id', $this->parliament_id)
                                          ->where('division_id', $this->division_id)
                                          ->where('keyword', 'LIKE', '%' . $this->search_key . '%')
                                          ->get();
    return view('livewire.secretariatdocumentarchives.index')->layout(getLayout());
  }


  /**
   * download
   * @param  mixed $id
   * @return void
   */
  public function download($id)
  {
    $sessiondoc = Secretariatdocument::where('id', $id)->firstOrFail();
    $file_path = public_path('uploads/' . $sessiondoc->document);
    return response()->download($file_path);
  }


  /**
   * search
   * @param  mixed $id
   * @return void
   */
  public function searchArchives()
  {
    $this->documents = Secretariatdocument::where('division_id', $this->division_id)
      ->where('file_index', $this->file_index)
      ->whereBetween('created_at', ['from_date','end_date'])
      ->where('keyword', 'LIKE', '%' . $this->search_key . '%')
      ->get();
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

  /**
   * showDocModal
   * @return void
   */
  public function showDocModal($id)
  {
    $this->viewDoc = true;
    $this->view_file = Secretariatdocument::where('id', $id)->first()->document;
  }

  /**
   * close  modal and reset the form 
   */
  public function closeModal()
  {
    $this->confirmItemAdd = false;
    $this->viewDoc = false;
  }
}
