<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin\Weblinkcategory;
use Livewire\Component;
use Livewire\WithPagination;

class Weblinkcategories extends Component
{
  use WithPagination;
  public $weblinkcategory;
  public $confirmItemDeletion = false;
  public $confirmItemAdd = false;

  protected $rules = [
    'weblinkcategory.name' => 'required',
  ];

  /**
   * Render page
   * @return void
   */
  public function render()
  {
    $weblinkcategories = Weblinkcategory::orderBy('created_at', 'asc')->paginate(15);
    return view('livewire.admin.weblinkcategories.index', compact('weblinkcategories'));
  }

  /**
   * store  data
   *
   * @return void
   */

  public function store()
  {
    $this->validate();
    if (isset($this->weblinkcategory->id)) {
      $this->weblinkcategory->save();
      session()->flash('message', 'Web link category  successfully updated!');
    } else {
      Weblinkcategory::create([
        'name' =>   $this->weblinkcategory['name'],
      ]);
      session()->flash('message', 'Web link category successfully created!');
    }
    $this->reset(['weblinkcategory']);
    $this->confirmItemAdd = false;
    return redirect()->back();
  }

  /**
   * display edit modal (route - model binding)
   */
  public function showEditModal(Weblinkcategory $weblinkcategory)
  {
    $this->weblinkcategory = $weblinkcategory;
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
   * Delete  item
   * @param  mixed $id
   * @return void
   */
  public function destroy(Weblinkcategory $weblinkcategory)
  {
    $weblinkcategory->delete();
    $this->confirmItemDeletion = false;
    session()->flash('message', 'Link category deleted successfully.');
    $this->reset(['weblinkcategory']);
    return redirect()->back();
  }

  /**
   * close  modal and reset the form 
   */
  public function closeModal()
  {
    $this->confirmItemAdd = false;
    $this->reset(['weblinkcategory']);
  }

}
