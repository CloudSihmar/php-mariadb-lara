<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Admin\Fileindex;
use Livewire\WithPagination;

class Fileindexes extends Component
{
  use WithPagination;
  public $index;
  public $confirmItemDeletion = false;
  public $confirmItemAdd = false;

  protected $rules = [
    'index.name' => 'required',
  ];

  /**
   * Render page
   *
   * @return void
   */
  public function render()
  {
    $indexes = Fileindex::orderBy('created_at', 'asc')->paginate(15);
    return view('livewire.admin.file-index.index', compact('indexes'));
  }

  /**
   * store  data
   *
   * @return void
   */
  public function store()
  {
    $this->validate();
    if (isset($this->index->id)) {
      $this->index->save();
      session()->flash('message', 'File index successfully updated!');
    } else {
      Fileindex::create([
        'name' => $this->index['name'],
      ]);
      session()->flash('message', 'File index successfully created!');
    }
    $this->reset(['index']);
    $this->confirmItemAdd = false;
    return redirect()->back();
  }

  /**
   * showEditModal
   * @param  mixed $category
   * @return void
   */
  public function showEditModal(Fileindex $index)
  {
    $this->index = $index;
    $this->confirmItemAdd = true;
  }

  /**
   * showDeleteModal
   * @param  mixed $id
   * @return void
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
  public function destroy(Fileindex $index)
  {
    $index->delete();
    $this->confirmItemDeletion = false;
    session()->flash('message', 'File index deleted successfully.');
    $this->reset(['index']);
    return redirect()->back();
  }

  /**
   * close  modal and reset the form 
   */
  public function closeModal()
  {
    $this->confirmItemAdd = false;
    $this->reset(['index']);
  }
}
