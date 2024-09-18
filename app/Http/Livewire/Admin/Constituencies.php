<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Admin\Constituency;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class Constituencies extends Component
{
    use WithPagination;
    public $constituencie;
    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;

    protected $rules = [
        'constituencie.name' => 'required',
        'constituencie.shortCode' => 'nullable',
      ];

    /**
     * Render page
     *
     * @return void
     */
    public function render()
    {
        $constituencies= Constituency::orderBy('name', 'asc')->paginate(25);
        return view('livewire.admin.constituencies.index', compact('constituencies'));
    }
  
  
    /**
     * store  data
     *
     * @return void
     */
  
    public function store()
    {
      $this->validate();
      
      if (isset($this->constituencie->id)) {
        $this->constituencie->save();
        session()->flash('message', 'Position Title successfully updated!');
      } else {
        Constituency::create([
            'name' => $this->constituencie['name'],
            'shortCode' => !empty($this->constituencie['shortCode']) ? $this->constituencie['shortCode']: '',
            'author' => Auth::user()->id
        ]);
        session()->flash('message', 'Constituency successfully created!');
      }
      $this->reset(['constituencie']);
      $this->confirmItemAdd = false;
      return redirect()->back();
    }
  
    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(Constituency $result)
    {
      $this->constituencie = $result;
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
    public function destroy(Constituency $result)
    {
      $result->delete();
      $this->confirmItemDeletion = false;
      session()->flash('message', 'Constituency deleted successfully.');
      $this->reset(['constituencie']);
      return redirect()->back();
    }
  
    /**
     * close  modal and reset the form 
     */
    public function closeModal()
    {
      $this->confirmItemAdd = false;
      $this->reset(['constituencie']);
    }
}
