<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin\Division;
use Livewire\Component;
use Livewire\WithPagination;

class Divisions extends Component
{
  use WithPagination;
    public $division;
    public $deptID;
    public $confirmItemDeletion = false;
    public $confirmItemAdd = false;
  
    protected $rules = [
    'division.name' => 'required',
    ];

  
  /**
   * mount
   * @param  mixed $deptID
   * @return void
   */
  public function mount($deptID)
  {
    $this->deptID = $deptID;
  }

    /**
     * Render page
     *
     * @return void
     */
    public function render()
    {
        $divisions= Division::where('department_id', $this->deptID)->where('status',1)->orderBy('created_at', 'asc')->paginate(10);
        return view('livewire.admin.division.index', compact('divisions'));
    }
  
  
    /**
     * store  data
     *
     * @return void
     */
  
    public function store()
    {
      $this->validate();
      if (isset($this->division->id)) {
        $this->division->save();
        session()->flash('message', 'Division successfully updated!');
      } else {
        Division::create([
            'name' => $this->division['name'],
            'status' => 1,
            'department_id' => $this->deptID,
        ]);
        session()->flash('message', 'Division successfully created!');
      }
      $this->reset(['division']);
      $this->confirmItemAdd = false;
      return redirect()->back();
    }
  
    /**
     * display edit modal (route - model binding)
     */
    public function showEditModal(Division $result)
    {
      $this->division = $result;
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
    public function destroy(Division $division)
    {
      // $division->delete();
      $division->status = 0;
      $division->save();

      $this->confirmItemDeletion = false;
      session()->flash('message', 'Division deleted successfully.');
      $this->reset(['division']);
      return redirect()->back();
    }
  
    /**
     * close  modal and reset the form 
     */
    public function closeModal()
    {
      $this->confirmItemAdd = false;
      $this->reset(['division']);
    }

}

