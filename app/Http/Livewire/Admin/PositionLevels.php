<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\PositionLevel;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class PositionLevels extends Component
{
  use WithPagination;
    public $positionlevel;
    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;

    protected $rules = [
        'positionlevel.name' => 'required',
        'positionlevel.shortCode' => 'nullable',
      ];

    /**
     * Render page
     *
     * @return void
     */
    public function render()
    {
        $positionlevels= PositionLevel::orderBy('created_at', 'asc')->paginate(20);
        return view('livewire.admin.positionlevels.index', compact('positionlevels'));
    }
  
  
    /**
     * store  data
     *
     * @return void
     */
  
    public function store()
    {
      $this->validate();
      if (isset($this->positionlevel->id)) {
        $this->positionlevel->save();
        session()->flash('message', 'Position Level successfully updated!');
      } else {
        PositionLevel::create([
            'name' => $this->positionlevel['name'],
            'shortCode' => !empty($this->positionlevel['shortCode']) ? $this->positionlevel['shortCode']: '',
            'author' => Auth::user()->id
        ]);
        session()->flash('message', 'Position Level successfully created!');
      }
      $this->reset(['positionlevel']);
      $this->confirmItemAdd = false;
      return redirect()->back();
    }
  
    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(PositionLevel $result)
    {
      $this->positionlevel = $result;
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
    public function destroy(PositionLevel $result)
    {
      $result->delete();
      $this->confirmItemDeletion = false;
      session()->flash('message', 'Position Level deleted successfully.');
      $this->reset(['positionlevel']);
      return redirect()->back();
    }
  
    /**
     * close  modal and reset the form 
     */
    public function closeModal()
    {
      $this->confirmItemAdd = false;
      $this->reset(['positionlevel']);
    }

}
