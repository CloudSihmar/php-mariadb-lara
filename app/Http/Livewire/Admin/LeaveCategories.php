<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Admin\Leavecategory;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class LeaveCategories extends Component
{
  use WithPagination;
    public $leavecategory;
    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;
  
    protected $rules = [
      'leavecategory.name' => 'required',
      'leavecategory.leaveCode' => 'required',
      'leavecategory.shortCode' => 'nullable',
    ];
  
    /**
     * Render page
     *
     * @return void
     */
    public function render()
    {
      $leavecategories = Leavecategory::orderBy('created_at', 'asc')->paginate(15);
      return view('livewire.admin.leave-categories.index', compact('leavecategories'));
    }
  
  
    /**
     * store  data
     *
     * @return void
     */
  
    public function store()
    {
      $this->validate();
      if (isset($this->leavecategory->id)) {
        $this->leavecategory->save();
        session()->flash('message', 'Leave Category successfully updated!');
      } else {
        LeaveCategory::create([
          'name' => $this->leavecategory['name'],
          'leaveCode' => $this->leavecategory['leaveCode'],
          'shortCode' => !empty($shortCode) ? $this->leavecategory['shortCode'] : '',
          'author' => Auth::user()->id,
          
        ]);
        session()->flash('message', 'Leave Category successfully created!');
      }
      $this->reset(['leavecategory']);
      $this->confirmItemAdd = false;
      return redirect()->back();
    }
  
    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(LeaveCategory $leave)
    {
      $this->leavecategory = $leave;
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
    public function destroy(Leavecategory $leave)
    {
      $leave->delete();
      $this->confirmItemDeletion = false;
      session()->flash('message', 'Leave Category deleted successfully.');
      $this->reset(['leavecategory']);
      return redirect()->back();
    }
  
    /**
     * close  modal and reset the form 
     */
    public function closeModal()
    {
      $this->confirmItemAdd = false;
      $this->reset(['leavecategory']);
    }
}
