<?php

namespace App\Http\Livewire;

use App\Models\Admin\Division;
use Livewire\Component;
use App\Models\Secretariatdocument;
use App\Models\Admin\Fileindex;
use App\Models\Admin\Divisionsubfolder;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\WithPagination;


class Secretariatdocuments extends Component
{
  use WithFileUploads;

  public $parID;
  public $division_id;
  public $division;

  public $name;
  public $keyword;
  public $document;
  public $file_index;
  public $fileindexes;
  public $viewDoc = false;
  public $view_file;

  public $addNewFolder = false;
  public $foldername;
  public $folder;
  public $confirmFolderDeletion = false;

  public $confirmItemDeletion = false;
  public $confirmItemAdd = false;

  protected $rules = [
    'name' => 'required',
    'file_index' => 'nullable',
    'division_id' => 'required',
    'keyword' => 'nullable',
    'document' => 'nullable' 
  ];
  /**
   * mount
   * @param  mixed $agencyID
   * @return void
   */
  public function mount()
  {
    $this->fileindexes = collect();
    $this->parID = getCurrentParliament()->id;

  }

  /**
   * render
   *
   * @return void
   */
  public function render()
  {
    $this->division_id = auth()->user()->division_id;
    $this->division = Division::where('id', $this->division_id)->first();
    $documents = Secretariatdocument::where('division_id', $this->division_id)->orderBy('id', 'DESC')->get();
    $this->fileindexes = Fileindex::all();
    $selectedDiv = Division::where('id', $this->division_id)->first();
    $subfolders = Divisionsubfolder::where('division_id', $this->division_id)->get();
    return view('livewire.secretariatdocuments.index', compact('documents', 'selectedDiv', 'subfolders'))->layout(getLayout());
  }

  /**
   * updatedFileIndex
   * @return void
   */
  // function updatedFileIndex()
  // {
  //   if(!$this->file_index=='')
  //     $this->fileindexes = Fileindex::where('name', 'LIKE', '%' . $this->file_index . '%')->get();
  //   else
  //     $this->fileindexes = collect();
  // }

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
    $foldername = 'SecretariatDocument/' . $this->division->name;
    $filepath = $this->document->storeAs($foldername, time() . '.' . $this->document->extension(), 'uploads');
    Secretariatdocument::create([
      'parliament_id' => $this->parID,
      'division_id' => $this->division_id,
      'file_index' => $this->file_index,
      'name' =>   $this->name,
      'keyword' =>   $this->keyword,
      'document' =>  $filepath,
      'extension' =>  $this->document->extension(),
    ]);


    $this->confirmItemAdd = false;
    $this->reset(['name', 'division_id','keyword', 'document']);
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
  public function destroy(Secretariatdocument $secretariatdocument)
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
    $this->view_file = Secretariatdocument::where('id', $id)->first()->document;
  }

  /**
   * close  modal and reset the form 
   */
  public function closeModal()
  {
    $this->confirmItemAdd = false;
    $this->viewDoc = false;
    $this->addNewFolder = false;
    $this->confirmFolderDeletion = false;
    $this->reset(['name', 'keyword', 'document']);
  }

  /**
   * download
   * @param  mixed $id
   * @return void
   */
  public function download($id)
  {
    $secretariatdocument = Secretariatdocument::where('id', $id)->firstOrFail();
    $file_path = public_path('uploads/' . $secretariatdocument->document);
    return response()->download($file_path);
  }



  /**
   * showEditFolder
   * @return void
   */
  public function showEditFolder($id)
  {
    $this->folder = Divisionsubfolder::find($id);
    $this->foldername = $this->folder->foldername;
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
    $this->folder = Divisionsubfolder::find($id);
    $this->confirmFolderDeletion = true;
  }



  /**
   * store  data
   * @return void
   */
  public function newfolder()
  {
    if (isset($this->folder->id)) {
      $this->folder->foldername = $this->foldername;
      $this->folder->save();
    } else {
      Divisionsubfolder::create([
        'division_id' => $this->division_id,
        'foldername' =>   $this->foldername
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
