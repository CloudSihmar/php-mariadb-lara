<?php

namespace App\Http\Livewire;

use App\Models\Admin\Division;
use Livewire\Component;
use App\Models\Secretariatsubfolderdocument;
use App\Models\Admin\Fileindex;
use App\Models\Admin\Divisionsubfolder;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\WithPagination;


class Secretariatsubdocuments extends Component
{
  use WithFileUploads;

  public $parID;
  public $divID;
  public $subdirID;

  public $name;
  public $keyword;
  public $document;
  public $file_index;
  public $fileindexes;
  public $viewDoc = false;
  public $view_file;

  public $confirmItemDeletion = false;
  public $confirmItemAdd = false;

  protected $rules = [
    'name' => 'required',
    'file_index' => 'nullable',
    'keyword' => 'nullable',
    'document' => 'nullable' 
  ];
  /**
   * mount
   * @param  mixed $agencyID
   * @return void
   */
  public function mount($parID, $divID, $subdirID)
  {
    $this->parID = $parID;
    $this->divID = $divID;
    $this->fileindexes = collect();
    $this->subdirID = $subdirID;

  }

  /**
   * render
   *
   * @return void
   */
  public function render()
  {
    $documents = Secretariatsubfolderdocument::where('division_id', $this->divID)
                                              ->where('sub_folder_id', $this->subdirID)
                                              ->orderBy('id', 'DESC')->get();
    $this->fileindexes = Fileindex::all();
    $selectedDiv = Division::where('id', $this->divID)->first();
    $subfolder = Divisionsubfolder::where('id', $this->subdirID)->first();
    return view('livewire.secretariatsubfolderdocuments.index', compact('documents', 'selectedDiv', 'subfolder'))->layout(getLayout());
  }

  /**
   * setValue
   * @return void
   */
      function setValue($name)
      {
        $this->file_index = $name;
        $this->fileindexes = collect();
      }
  /**
   * store  data
   * @return void
   */
  public function store()
  {
    $this->validate();
    $foldername = 'SecretariatDocument/'. $this->name;
    $filepath = $this->document->storeAs($foldername, time() . '.' . $this->document->extension(), 'uploads');
    Secretariatsubfolderdocument::create([
      'parliament_id' => $this->divID,
      'division_id' => $this->divID,
      'sub_folder_id' => $this->subdirID,
      'file_index' => $this->file_index,
      'name' =>   $this->name,
      'keyword' =>   $this->keyword,
      'document' =>  $filepath,
      'extension' =>  $this->document->extension(),
    ]);


    $this->confirmItemAdd = false;
    $this->reset(['name','keyword', 'document']);
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
  public function destroy(Secretariatsubfolderdocument $secretariatdocument)
  {
    $secretariatdocument->delete();
    Storage::disk('uploads')->delete($secretariatdocument->document);
    $this->confirmItemDeletion = false;
    session()->flash('message', 'Document deleted successfully.');
  }

  /**
   * showDocModal
   * @return void
   */
  public function showDocModal($id)
  {
    $this->viewDoc = true;
    $this->view_file = Secretariatsubfolderdocument::where('id', $id)->first()->document;
  }

  /**
   * close  modal and reset the form 
   */
  public function closeModal()
  {
    $this->confirmItemAdd = false;
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
    $secretariatdocument = Secretariatsubfolderdocument::where('id', $id)->firstOrFail();
    $file_path = public_path('uploads/' . $secretariatdocument->document);
    return response()->download($file_path);
  }
}
