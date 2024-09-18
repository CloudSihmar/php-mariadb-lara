<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin\SessiondocCategory;
use Livewire\Component;
use Livewire\WithPagination;

class SessiondocCategories extends Component
{
  use WithPagination;

  public $category;
  public $confirmItemDeletion = false;
  public $confirmItemAdd = false;

  protected $rules = [
    'category.name' => 'required',
  ];



  /**
   * Render page
   *
   * @return void
   */
  public function render()
  {
    $categories = SessiondocCategory::orderBy('created_at', 'asc')->paginate(15);
    return view('livewire.admin.sessiondoc-categories.index', compact('categories'));
  }


  /**
   * store  data
   *
   * @return void
   */

  public function store()
  {
    $this->validate();
    if (isset($this->category->id)) {
      $this->category->save();
      session()->flash('message', 'Category successfully updated!');
    } else {
      SessiondocCategory::create([
        'name' => $this->category['name'],
      ]);
      session()->flash('message', 'Category successfully created!');
    }
    $this->reset(['category']);
    $this->confirmItemAdd = false;
    return redirect()->back();
  }

  /**
   * showEditModal
   * @param  mixed $category
   * @return void
   */
  public function showEditModal(SessiondocCategory $category)
  {
    $this->category = $category;
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
  public function destroy(SessiondocCategory $category)
  {
    $category->delete();
    $this->confirmItemDeletion = false;
    session()->flash('message', 'Category deleted successfully.');
    $this->reset(['category']);
    return redirect()->back();
  }

  /**
   * close  modal and reset the form 
   */
  public function closeModal()
  {
    $this->confirmItemAdd = false;
    $this->reset(['category']);
  }
}
