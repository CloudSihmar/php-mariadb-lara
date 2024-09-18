<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Role;
use App\Models\Permission;
use Livewire\WithPagination;

class Roles extends Component
{

  use WithPagination;
  
  public $role;
  public $permissions;
  public $selecedpermissions = [];
  public $confirmItemDeletion = false;
  public $confirmItemAdd = false;
  public $assignPermission = false;

  protected $rules = [
    'role.name' => 'required',
    'role.slug' => 'nullable',
  ];

  /**
   * Render page
   *
   * @return void
   */
  public function render()
  {
    $roles = Role::orderBy('created_at', 'asc')->paginate(15);
    $this->permissions = Permission::all();
    return view('livewire.admin.roles.index', compact('roles'));
  }


  /**
   * store  data
   *
   * @return void
   */

  public function store()
  {
    $this->validate();
    if (isset($this->role->id)) {
      $this->role->save();
      session()->flash('message', 'role successfully updated!');
    } else {
      Role::create([
        'name' =>   $this->role['name'],
        'slug' => $this->role['name'],
      ]);
      session()->flash('message', 'role successfully created!');
    }
    $this->reset(['role']);
    $this->confirmItemAdd = false;
    return redirect()->back();
  }

  /**
   * display edit modal (route - model binding)
   */
  public function showEditModal(Role $role)
  {
    $this->role = $role;
    $this->confirmItemAdd = true;
  }


  /**
   * display edit modal (route - model binding)
   */
  public function showAssignPermission(Role $role)
  {
    $this->assignPermission = true;
    $this->role = $role;
    $this->selecedpermissions = $role->permissions->pluck('slug');
    $this->confirmItemAdd = false;
  }

  /**
   * display edit modal (route - model binding)
   */
  public function assignPermission()
  {
    $this->role->refreshPermissions($this->selecedpermissions);
    $this->confirmItemAdd = false;
    $this->assignPermission = false;
    return redirect()->back();
  }

  // /**
  //  * display edit modal (route - model binding)
  //  */
  // public function revokePermission()
  // {
  //   $this->role->deletePermissions($this->selecedpermissions);
  //   $this->confirmItemAdd = false;
  //   $this->assignPermission = false;
  //   return redirect()->back();
  // }

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
  public function destroy(Role $role)
  {
    $role->delete();
    $this->confirmItemDeletion = false;
    session()->flash('message', 'role deleted successfully.');
    $this->reset(['role']);
    return redirect()->back();
  }

  /**
   * close  modal and reset the form 
   */
  public function closeModal()
  {
    $this->confirmItemAdd = false;
    $this->assignPermission = false;
    $this->reset(['role']);
  }

}
