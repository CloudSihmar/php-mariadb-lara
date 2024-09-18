<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin\Committee;
use App\Models\Admin\Committeemember;
use App\Models\Admin\Parliament;
use App\Models\Admin\Department;
use App\Models\User;
use Livewire\Component;

class Committeemembers extends Component
{
  public $parID;
  public $comID;
  public $users;
  public $committeemember;
  public $committeemembers;
  public $committee_member_from;
  public $confirmItemDeletion = false;
  public $confirmItemAdd = false;

  protected $rules = [
    'committeemember.user_id' => 'required',
    'committeemember.comm_designation' => 'required',
  ];

  
  /**
   * mount
   * @param  mixed $comID
   * @return void
   */
  function mount($parID,$cID){
    $this->parID = $parID;
    $this->comID = $cID;
    $this->users = collect();
  }
  /**
   * Render page
   *
   * @return void
   */
  public function render()
  {
    $committees = Committee::all();
    $departments = Department::all();
    $this->committeemembers = Committeemember::where('committee_id', $this->comID)->orderBy('created_at', 'asc')->get();
    return view('livewire.admin.committeemembers.index', compact('committees', 'departments'));
  }

   
   /**
    * UpdatedMommitteeMemberFrom
    * @return void
    */
   function UpdatedCommitteeMemberFrom()
   {
    $this->users = User::where('department_id', $this->committee_member_from)->get();
   }
  /**
   * store  data
   *
   * @return void
   */

  public function store()
  {
    $this->validate();
    if (isset($this->committeemember->id)) {
      $this->committeemember->committee_member_from = $this->committee_member_from;
      $this->committeemember->save();
      session()->flash('message', 'Committee member successfully updated!');
    } else {
      Committeemember::create([
        'user_id' => $this->committeemember['user_id'],
        'committee_id' => $this->comID,
        'parliament_id' => $this->parID,
        'committee_member_from' => $this->committee_member_from,
        'comm_designation' => $this->committeemember['comm_designation'],
      ]);
      session()->flash('message', 'Committee member successfully created!');
    }
    $this->confirmItemAdd = false;
    return redirect()->back();
  }

  /**
   * display edit modal (route - model binding)
   */
  public function showEditModal(Committeemember $committeemember)
  {
    $this->committeemember = $committeemember;
    $this->committee_member_from = $committeemember->committee_member_from;
    $this->users = User::where('department_id', $committeemember->committee_member_from)->get();
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
  public function destroy(Committeemember $committeemember)
  {
    $committeemember->delete();
    $this->confirmItemDeletion = false;
    session()->flash('message', 'Committee member deleted successfully.');
    $this->reset(['committeemember']);
    return redirect()->back();
  }


  /**
   * close  modal and reset the form 
   */
  public function closeModal()
  {
    $this->confirmItemAdd = false;
    $this->reset(['committeemember']);
  }
}
