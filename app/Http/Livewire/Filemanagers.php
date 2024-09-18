<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Filemanager;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Filemanagers extends Component
{
  use WithFileUploads;
  public $docID;
  public $directory_name;
  public $filename;
  public $attachment;
  public $confirmItemAdd;

  protected $rules = [
    'filename' => 'required',
    'attachment' => 'required|file|mimes:jpeg,png,jpg,pdf'

  ];

  /**
   * Mount Function
   */
  public function mount($docID, $directory_name)
  {
    $this->docID = $docID;
    $this->directory_name = $directory_name;
  }

  /**
   * The livewire render function
   *
   * @return void
   */
  public function render()
  {
    $attachments = Filemanager::where('doc_id', $this->docID)->orderBy('created_at', 'asc')->get();
    return view('livewire.filemanagers', compact('attachments'));
  }

  /**
   * store notification
   *
   * @return void
   */

  public function store()
  {
    $this->validate();

    $filepath = $this->attachment->storeAs($this->directory_name, time(). '_' .$this->filename. '.' . $this->attachment->extension(), 'uploads');
    Filemanager::create([
      'doc_id' => $this->docID,
      'filename' =>   $this->filename,
      'filepath' =>  $filepath,
      'author' => Auth::user()->id
    ]);
   
    $this->confirmItemAdd = false;
    $this->reset(['filename']);
  }


  /**
   * Delete  item
   * @param  mixed $id
   * @return void
   */
  public function destroy(Filemanager $doc)
  {
    $doc->delete();
    Storage::disk('uploads')->delete($doc->filepath);
    $this->confirmItemDeletion = false;
    session()->flash('message', 'Document deleted successfully.');
  }

  /**
   * close  modal and reset the form 
   */
  public function closeModal()
  {
    $this->confirmItemAdd = false;
    $this->reset(['filename']);
  }
}
