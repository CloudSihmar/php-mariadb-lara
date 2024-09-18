<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Admin\Dzongkhag;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class Dzongkhags extends Component
{
  use WithPagination;
    public $dzongkhag;
    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;

    protected $rules = [
        'dzongkhag.name' => 'required',
        'dzongkhag.shortCode' => 'nullable',
      ];

    /**
     * Render page
     *
     * @return void
     */
    public function render()
    {
        $dzongkhags= Dzongkhag::orderBy('created_at', 'asc')->paginate(25);
        return view('livewire.admin.dzongkhags.index', compact('dzongkhags'));
    }
  
  
    /**
     * store  data
     *
     * @return void
     */
  
    public function store()
    {
      $this->validate();
      if (isset($this->dzongkhag->id)) {
        $this->dzongkhag->save();
        session()->flash('message', 'Dzongkhag successfully updated!');
      } else {
        Dzongkhag::create([
            'name' => $this->dzongkhag['name'],
            'shortCode' => !empty($this->dzongkhag['shortCode']) ? $this->dzongkhag['shortCode']: '',
            'author' => Auth::user()->id
        ]);
        session()->flash('message', 'Dzongkhag successfully created!');
      }
      $this->reset(['dzongkhag']);
      $this->confirmItemAdd = false;
      return redirect()->back();
    }
  
    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(Dzongkhag $result)
    {
      $this->dzongkhag = $result;
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
    public function destroy(Dzongkhag $result)
    {
      $result->delete();
      $this->confirmItemDeletion = false;
      session()->flash('message', 'Dzongkhag deleted successfully.');
      $this->reset(['dzongkhag']);
      return redirect()->back();
    }
  
    /**
     * close  modal and reset the form 
     */
    public function closeModal()
    {
      $this->confirmItemAdd = false;
      $this->reset(['dzongkhag']);
    }
}
