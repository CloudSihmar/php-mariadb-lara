<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin\Committee;
use App\Models\Admin\Parliament;
use Livewire\Component;
use Livewire\WithPagination;


class Committees extends Component
{
  use WithPagination;
  public $committee;
  public $parID;
  public $confirmItemDeletion = false;
  public $confirmItemAdd = false;

  protected $rules = [
    'committee.name' => 'required',
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
   *
   * @return void
   */
  public function render()
  {
    $committees = Committee::where('parliament_id', $this->parID)->orderBy('created_at', 'desc')->paginate(15);
    return view('livewire.admin.committees.index', compact('committees'));
  }


  /**
   * store  data
   *
   * @return void
   */

  public function store()
  {
    $this->validate();
    if (isset($this->committee->id)) {
      $this->committee->save();
      session()->flash('message', 'Committee successfully updated!');
    } else {
      Committee::create([
        'parliament_id' => $this->parID,
        'name' => $this->committee['name'],
      ]);
      session()->flash('message', 'Committee successfully created!');
    }
    $this->reset(['committee']);
    $this->confirmItemAdd = false;
    return redirect()->back();
  }

  /**
   * display edit modal (route - model binding)
   */
  public function showEditModal(Committee $committee)
  {
    $this->committee = $committee;
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
  public function destroy(Committee $committee)
  {
    $committee->delete();
    $this->confirmItemDeletion = false;
    session()->flash('message', 'committee deleted successfully.');
    $this->reset(['committee']);
    return redirect()->back();
  }

  /**
   * close  modal and reset the form 
   */
  public function closeModal()
  {
    $this->confirmItemAdd = false;
    $this->reset(['committee']);
  }
}
