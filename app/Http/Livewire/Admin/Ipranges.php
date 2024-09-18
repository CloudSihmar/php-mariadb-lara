<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin\Iprange;
use Livewire\Component;
use Livewire\WithPagination;

class Ipranges extends Component
{
  use WithPagination;
  public $iprange;
  public $confirmItemDeletion = false;

  protected $rules = [
    'iprange.start_ip' => 'required',
    'iprange.end_ip' => 'required',
  ];

  /**
   * Render page
   *
   * @return void
   */
  public function render()
  {
    $ipranges = Iprange::orderBy('created_at', 'asc')->paginate(15);
    return view('livewire.admin.ipranges.index', compact('ipranges'));
  }

  /**
   * store  data
   *
   * @return void
   */
  public function store()
  {
    $this->validate();
    if (isset($this->iprange->id)) {
      $this->iprange->save();
      session()->flash('message', 'IP range successfully updated!');
    } else {
      Iprange::create([
        'start_ip' => $this->iprange['start_ip'],
        'end_ip' => $this->iprange['end_ip'],
      ]);
      session()->flash('message', 'IP range successfully created!');
    }
    $this->reset(['iprange']);
    return redirect()->back();
  }

  /**
   * showEditModal
   * @param  mixed $category
   * @return void
   */
  public function edit(Iprange $iprange)
  {
    $this->iprange = $iprange;
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
  public function destroy(Iprange $iprange)
  {
    $iprange->delete();
    $this->confirmItemDeletion = false;
    session()->flash('message', 'IP range deleted successfully.');
    $this->reset(['iprange']);
    return redirect()->back();
  }

  /**
   * close  modal and reset the form 
   */
  public function closeModal()
  {
    $this->confirmItemAdd = false;
    $this->reset(['iprange']);
  }
}
