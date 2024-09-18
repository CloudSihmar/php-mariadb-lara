<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin\Conferencehall;
use Livewire\Component;
use Livewire\WithPagination;

class Conferencehalls extends Component
{
  use WithPagination;
  public $conferencehall;
  public $confirmItemDeletion = false;
  public $confirmItemAdd = false;

  protected $rules = [
    'conferencehall.name' => 'required',
  ];

  /**
   * Render page
   * @return void
   */
  public function render()
  {
    $conferencehalls = Conferencehall::orderBy('created_at', 'asc')->paginate(15);
    return view('livewire.admin.conferencehalls.index', compact('conferencehalls'));
  }

  /**
   * store  data
   *
   * @return void
   */

  public function store()
  {
   $this->validate();
    if (isset($this->conferencehall->id)) {
      $this->conferencehall->save();
      session()->flash('message', 'Conference hall updated successfully!');
    } else {
      Conferencehall::create([
        'name' => $this->conferencehall['name'],
      ]);
      session()->flash('message', 'Conference hall added successfully!');
    }
    $this->reset(['conferencehall']);
    $this->confirmItemAdd = false;
    return redirect()->back();
  }

  /**
   * display edit modal (route - model binding)
   */
  public function showEditModal(Conferencehall $conferencehall)
  {
    $this->conferencehall = $conferencehall;
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
  public function destroy(Conferencehall $conferencehall)
  {
    $conferencehall->delete();
    $this->confirmItemDeletion = false;
    session()->flash('message', 'Conference hall deleted successfully.');
    $this->reset(['conferencehall']);
    return redirect()->back();
  }

  /**
   * close  modal and reset the form 
   */
  public function closeModal()
  {
    $this->confirmItemAdd = false;
    $this->reset(['conferencehall']);
  }


}
