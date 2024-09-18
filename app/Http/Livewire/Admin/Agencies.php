<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Admin\Agency;
use Livewire\WithPagination;

class Agencies extends Component
{
    use WithPagination;
    public $agency;
    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;
  
    protected $rules = [
      'agency.name' => 'required',
    ];
  
    /**
     * Render page
     *
     * @return void
     */
    public function render()
    {
      $agencies = Agency::with('user')->orderBy('created_at', 'asc')->paginate(10);
      return view('livewire.admin.agency.index', compact('agencies'));
    }
  
  
    /**
     * store  data
     *
     * @return void
     */
  
    public function store()
    {
      $this->validate();
      if (isset($this->agency->id)) {
        $this->agency->save();
        session()->flash('message', 'Agency successfully updated!');
      } else {
        Agency::create([
          'name' => $this->agency['name'],
        ]);
        session()->flash('message', 'Agency successfully created!');
      }
      $this->reset(['agency']);
      $this->confirmItemAdd = false;
      return redirect()->back();
    }
  
    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(Agency $agency)
    {
      $this->agency = $agency;
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
    public function destroy(Agency $agency)
    {
      $agency->delete();
      $this->confirmItemDeletion = false;
      session()->flash('message', 'Agency deleted successfully.');
      $this->reset(['agency']);
      return redirect()->back();
    }
  
    /**
     * close  modal and reset the form 
     */
    public function closeModal()
    {
      $this->confirmItemAdd = false;
      $this->reset(['agency']);
    }
}
