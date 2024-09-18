<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\PositionTitle;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class PositionTitles extends Component
{
  use WithPagination;
    public $positiontitle;
    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;

    protected $rules = [
        'positiontitle.name' => 'required',
        'positiontitle.shortCode' => 'nullable',
      ];

    /**
     * Render page
     *
     * @return void
     */
    public function render()
    {
        $positiontitles= PositionTitle::orderBy('created_at', 'asc')->paginate(20);
        return view('livewire.admin.positiontitles.index', compact('positiontitles'));
    }
  
  
    /**
     * store  data
     *
     * @return void
     */
  
    public function store()
    {
      $this->validate();
      if (isset($this->positiontitle->id)) {
        $this->positiontitle->save();
        session()->flash('message', 'Position Title successfully updated!');
      } else {
        PositionTitle::create([
            'name' => $this->positiontitle['name'],
            'shortCode' => !empty($this->positiontitle['shortCode']) ? $this->positiontitle['shortCode']: '',
            'author' => Auth::user()->id
        ]);
        session()->flash('message', 'Position Title successfully created!');
      }
      $this->reset(['positiontitle']);
      $this->confirmItemAdd = false;
      return redirect()->back();
    }
  
    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(PositionTitle $result)
    {
      $this->positiontitle = $result;
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
    public function destroy(PositionTitle $result)
    {
      $result->delete();
      $this->confirmItemDeletion = false;
      session()->flash('message', 'Position Title deleted successfully.');
      $this->reset(['positiontitle']);
      return redirect()->back();
    }
  
    /**
     * close  modal and reset the form 
     */
    public function closeModal()
    {
      $this->confirmItemAdd = false;
      $this->reset(['positiontitle']);
    }

}
