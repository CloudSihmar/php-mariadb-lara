<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Admin\Parliament;
use Livewire\WithPagination;

class Parliaments extends Component
{
  use WithPagination;
  public $parliament;
  public $shortCode;
  public $confirmItemDeletion = false;
  public $confirmItemAdd = false;

  protected $rules = [
    'parliament.name' => 'required',
  ];

  /**
   * Render page
   *
   * @return void
   */
  public function render()
  {
    $parliaments = Parliament::orderBy('created_at', 'desc')->paginate(10);
    return view('livewire.admin.parliaments.index', compact('parliaments'));
  }


  /**
   * store  data
   *
   * @return void
   */

  public function store()
  {
    $this->validate();
    if (isset($this->parliament->id)) {
      $this->parliament->shortCode = $this->shortCode;
      $this->parliament->save();
      session()->flash('message', 'Parliament successfully updated!');
    } else {
        Parliament::create([
        'name' => $this->parliament['name'],
        'shortCode' => $this->shortCode,
      ]);
      session()->flash('message', 'parliament Category successfully created!');
    }
    $this->reset(['parliament']);
    $this->shortCode = null;
    $this->confirmItemAdd = false;
    return redirect()->back();
  }

  /**
   * display edit modal (route - model binding)
   */
  public function showEditModal(Parliament $parliament)
  {
    $this->parliament = $parliament;
    $this->shortCode = $parliament->shortCode;
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
   *
   * @param  mixed $id
   * @return void
   */
  public function destroy(Parliament $parliament)
  {
    $parliament->delete();
    $this->confirmItemDeletion = false;
    session()->flash('message', 'Parliament deleted successfully.');
    $this->reset(['parliament']);
    return redirect()->back();
  }

  /**
   * close  modal and reset the form 
   */
  public function closeModal()
  {
    $this->confirmItemAdd = false;
    $this->reset(['parliament']);
  }
}
