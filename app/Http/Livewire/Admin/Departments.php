<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Admin\Department;
use Livewire\WithPagination;

class Departments extends Component
{
  use WithPagination;
    public $agencyID;
    public $department;
    public $departments;
    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;
  
    protected $rules = [
      'department.name' => 'required',
    ];

    
    /**
     * mount
     * @param  mixed $agencyID
     * @return void
     */
    public function mount($agencyID){
      $this->agencyID = $agencyID;
      $this->departments = collect();
    }

    /**
     * Render page
     *
     * @return void
     */
    public function render()
    {
        $this->departments = Department::with('user')->where('agency_id', $this->agencyID)->orderBy('created_at', 'asc')->get();
        return view('livewire.admin.department.index');
    }
  
  
    /**
     * store  data
     *
     * @return void
     */
    public function store()
    {
      $this->validate();
      if (isset($this->department->id)) {
        $this->department->save();
        session()->flash('message', 'Department successfully updated!');
      } else {
        Department::create([
            'name' => $this->department['name'],
            'agency_id' => $this->agencyID,
            'author' => auth()->user()->id,
        ]);
        session()->flash('message', 'Department successfully created!');
      }
      $this->reset(['department']);
      $this->confirmItemAdd = false;
      return redirect()->back();
    }
  
    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(Department $result)
    {
      $this->department = $result;
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
    public function destroy(Department $department)
    {
      $department->delete();
      $this->confirmItemDeletion = false;
      session()->flash('message', 'Dept deleted successfully.');
      $this->reset(['department']);
      return redirect()->back();
    }
  
    /**
     * close  modal and reset the form 
     */
    public function closeModal()
    {
      $this->confirmItemAdd = false;
      $this->reset(['department']);
    }
}
