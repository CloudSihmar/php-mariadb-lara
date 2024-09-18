<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin\Sessiondocumentsubcategory;
use Livewire\Component;
use Livewire\WithPagination;

class SessiondocumentSubCategories extends Component
{
  use WithPagination;
  public $subcategory;
  public $catID;
  public $confirmItemDeletion = false;
  public $confirmItemAdd = false;

  protected $rules = [
    'subcategory.name' => 'required',
  ];


  public function mount($catID){
    $this->catID = $catID;
  }

  /**
   * Render page
   *
   * @return void
   */
  public function render()
  {
    $subcategorys = Sessiondocumentsubcategory::where('category_id', $this->catID)->orderBy('created_at', 'asc')->paginate(15);
    return view('livewire.admin.sessiondocumentsubcategory.index', compact('subcategorys'));
  }


  /**
   * store  data
   *
   * @return void
   */

  public function store()
  {
    $this->validate();
    if (isset($this->subcategory->id)) {
      $this->subcategory->save();
      session()->flash('message', 'Folder name updated!');
    } else {
      Sessiondocumentsubcategory::create([
        'category_id' => $this->catID,
        'name' => $this->subcategory['name'],
      ]);
      session()->flash('message', 'Folder created!');
    }
    $this->reset(['subcategory']);
    $this->confirmItemAdd = false;
    return redirect()->back();
  }

  /**
   * showEditModal
   * @param  mixed $subcategory
   * @return void
   */
  public function showEditModal(Sessiondocumentsubcategory $subcategory)
  {
    $this->subcategory = $subcategory;
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
  public function destroy(Sessiondocumentsubcategory $subcategory)
  {
    $subcategory->delete();
    $this->confirmItemDeletion = false;
    session()->flash('message', 'Folder deleted');
    $this->reset(['subcategory']);
    return redirect()->back();
  }

  /**
   * close  modal and reset the form 
   */
  public function closeModal()
  {
    $this->confirmItemAdd = false;
    $this->reset(['subcategory']);
  }

}
