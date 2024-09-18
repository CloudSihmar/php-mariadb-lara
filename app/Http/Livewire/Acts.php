<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Act;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class Acts extends Component
{
  use WithFileUploads;
  public $act;
  public $name;
  public $keyword;
  public $document;
  public $confirmItemDeletion = false;
  public $confirmItemAdd = false;
  public $viewDoc = false;
  public $view_file;

  protected $rules = [
    'act.name' => 'required',
    'act.keyword' => 'nullable',
    'act.document' => 'nullable' 
  ];

  protected $messages = [
    'act.name' => 'This field is required',
  ];

  /**
   * store  data
   * @return void
   */

  public function render()
  {
      $documents = Act::latest()->paginate(15);
      return view('livewire.acts.index', compact('documents'));
  }

  /**
   * store  data
   * @return void
   */
  public function store()
  {
    $this->validate();
    if (isset($this->act->id)) {
      if (isset($this->document)) {
        $this->validate(['document' => 'required|file|mimes:jpg,png,jpeg,gif,svg,pdf,doc,docx,xls,xlsx']);
        if (Storage::disk('uploads')->exists($this->act->document)) {
          Storage::disk('uploads')->delete($this->act->document);
        }
        $this->act->extension =  $this->document->extension();
        $this->act->document = $this->document->storeAs('Acts', time() . '.' . $this->document->extension(), 'uploads');
      }
      $this->act->save();
      session()->flash('message', 'Document updated successfully!');
    } else {
      $this->validate(['document' => 'required|file|mimes:jpg,png,jpeg,gif,svg,pdf,doc,docx,xls,xlsx']);
      $filename = $this->document->storeAs('acts', time() . '.' . $this->document->extension(), 'uploads');
      Act::create([
        'name' =>   $this->act['name'],
        'keyword' =>   $this->act['keyword'],
        'document' => $filename,
        'extension' =>  $this->document->extension(),
      ]);
      session()->flash('message', 'Document added successfully !');
    }

    $this->reset(['act']);
    $this->confirmItemAdd = false;
    return redirect()->back();
  }

  

  /**
   * Delete  item
   *
   * @param  mixed $id
   * @return void
   */
  public function destroy(Act $act)
  {
    $act->delete();
    $this->confirmItemDeletion = false;
    session()->flash('message', 'Document deleted successfully.');
    $this->reset(['act']);
    return redirect()->back();
  }


  /**
   * display edit modal
   */
  public function showEditModal(Act $act)
  {
    $this->act = $act;
    $this->confirmItemAdd = true;
  }

  /**
   * Display confim deletion modal.
   */

  public function showDeleteModal($id)
  {
    $this->confirmItemDeletion = $id;
  }

  /**
   * close  modal and reset the form 
   */
  public function closeModal()
  {
    $this->confirmItemAdd = false;
    $this->viewDoc = false;
    $this->reset(['act']);
  }


  /**
   * showDocModal
   * @return void
   */
  public function showDocModal($id)
  {
    $this->viewDoc = true;
    $this->view_file = Act::where('id', $id)->first()->document;
  }

  /**
   * download
   * @param  mixed $id
   * @return void
   */
  public function download($id)
  {
    $act = Act::where('id', $id)->firstOrFail();
    $file_path = public_path('uploads/' . $act->document);
    return response()->download($file_path);
  }
 
}
