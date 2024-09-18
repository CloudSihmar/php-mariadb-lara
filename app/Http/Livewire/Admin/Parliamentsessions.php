<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin\Parliamentsession;
use Livewire\Component;
use Livewire\WithPagination;

class Parliamentsessions extends Component
{
  use WithPagination;
  public $parliamentsession;
  public $pID;
  public $shortCode;
  public $confirmItemDeletion = false;
  public $confirmItemAdd = false;

  protected $rules = [
    'parliamentsession.name' => 'required',
  ];

  /**
   * mount
   * @param  mixed $agencyID
   * @return void
   */
  public function mount($pID)
  {
    $this->parID = $pID;
  }


  /**
   * Render page
   * @return void
   */
  public function render()
  {
    $parliamentsessions = Parliamentsession::where('parliament_id', $this->parID)->orderBy('created_at', 'desc')->paginate(15);
    return view('livewire.admin.parliamentsessions.index', compact('parliamentsessions'));
  }


  /**
   * store  data
   *
   * @return void
   */

  public function store()
  {
    $this->validate();
    if (isset($this->parliamentsession->id)) {
      $this->parliamentsession->shortCode = $this->shortCode;
      $this->parliamentsession->save();
      session()->flash('message', 'Session successfully updated!');
    } else {
      Parliamentsession::create([
        'parliament_id' =>   $this->parID,
        'name' =>   $this->parliamentsession['name'],
        'shortCode' => $this->shortCode,
      ]);
      session()->flash('message', 'Session successfully created!');
    }
    $this->reset(['parliamentsession']);
    $this->confirmItemAdd = false;
    $this->shortCode = null;
    return redirect()->back();
  }

  /**
   * display edit modal (route - model binding)
   */
  public function showEditModal(Parliamentsession $parliamentsession)
  {
    $this->parliamentsession = $parliamentsession;
    $this->shortCode = $parliamentsession->shortCode;
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
  public function destroy(Parliamentsession $parliamentsession)
  {
    $parliamentsession->delete();
    $this->confirmItemDeletion = false;
    session()->flash('message', 'Session deleted successfully.');
    $this->reset(['parliamentsession']);
    return redirect()->back();
  }

  /**
   * close  modal and reset the form 
   */
  public function closeModal()
  {
    $this->confirmItemAdd = false;
    $this->reset(['parliamentsession']);
  }

}
