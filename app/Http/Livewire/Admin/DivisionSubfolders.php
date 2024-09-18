<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin\Divisionsubfolder;
use Livewire\Component;
use Livewire\WithPagination;

class DivisionSubfolders extends Component
{
  use WithPagination;
  public $subdirectory;
  public $divID;
  public $confirmItemDeletion = false;
  public $confirmItemAdd = false;

  protected $rules = [
    'subdirectory.name' => 'required',
  ];


  public function mount($divID){
    $this->divID = $divID;
  }

  /**
   * Render page
   *
   * @return void
   */
  public function render()
  {
    $subdirectorys = Divisionsubfolder::where('division_id', $this->divID)->orderBy('created_at', 'asc')->paginate(15);
    return view('livewire.admin.divisiontsubfolder.index', compact('subdirectorys'));
  }


  /**
   * store  data
   *
   * @return void
   */

  public function store()
  {
    $this->validate();
    if (isset($this->subdirectory->id)) {
      $this->subdirectory->save();
      session()->flash('message', 'Folder name updated!');
    } else {
      Divisionsubfolder::create([
        'division_id' => $this->divID,
        'name' => $this->subdirectory['name'],
      ]);
      session()->flash('message', 'Folder created!');
    }
    $this->reset(['subdirectory']);
    $this->confirmItemAdd = false;
    return redirect()->back();
  }

  /**
   * showEditModal
   * @param  mixed $subdirectory
   * @return void
   */
  public function showEditModal(Divisionsubfolder $subdirectory)
  {
    $this->subdirectory = $subdirectory;
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
  public function destroy(Divisionsubfolder $subdirectory)
  {
    $subdirectory->delete();
    $this->confirmItemDeletion = false;
    session()->flash('message', 'Folder deleted');
    $this->reset(['subdirectory']);
    return redirect()->back();
  }

  /**
   * close  modal and reset the form 
   */
  public function closeModal()
  {
    $this->confirmItemAdd = false;
    $this->reset(['subdirectory']);
  }

}
