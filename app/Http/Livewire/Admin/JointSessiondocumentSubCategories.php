<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin\Jointsittingdocumentsubdirectory;
use Livewire\Component;
use Livewire\WithPagination;

class JointSessiondocumentSubCategories extends Component
{
  use WithPagination;
  public $subdirectory;
  public $dirID;
  public $confirmItemDeletion = false;
  public $confirmItemAdd = false;

  protected $rules = [
    'subdirectory.name' => 'required',
  ];


  public function mount($dirID){
    $this->dirID = $dirID;
  }

  /**
   * Render page
   *
   * @return void
   */
  public function render()
  {
    $subdirectorys = Jointsittingdocumentsubdirectory::where('directory_id', $this->dirID)->orderBy('created_at', 'asc')->paginate(15);
    return view('livewire.admin.jointsessiondocumentsubcategory.index', compact('subdirectorys'));
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
      Jointsittingdocumentsubdirectory::create([
        'directory_id' => $this->dirID,
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
  public function showEditModal(Jointsittingdocumentsubdirectory $subdirectory)
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
  public function destroy(Jointsittingdocumentsubdirectory $subdirectory)
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
