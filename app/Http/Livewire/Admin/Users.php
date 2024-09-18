<?php

namespace App\Http\Livewire\Admin;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use App\Models\Admin\Agency;
use App\Models\LeaveBalance;
use App\Models\PositionLevel;
use App\Models\PositionTitle;
use App\Models\Admin\Division;
use App\Models\Admin\Dzongkhag;
use App\Models\Admin\Department;
use App\Models\Admin\Constituency;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;

class Users extends Component
{
  use WithPagination;
  public $user;
  public $name;
  public $roles;
  public $role_id;
  public $password;
  public $userList;
  public $usersids;
  public $users_id = [];
  public $password_confirmation;
  public $agencies;
  public $confirmItemDeletion = false;
  public $confirmItemAdd = false;
  public $assignRole = false;
  public $subordinate = false;
  public $supervisor = false;
  public $users_ids_array = [];
  public $positionlevels;
  public $positiontitles;
  public $departments;
  public $constituencies;
  public $dzongkhags;
  public $divisions;
  public $email;
  public $username;

  public $agency_id;
  public $dzongkhag_id;
  public $constituency_id;
  public $empid;
  public $cid;
  public $positiontitle;
  public $positionlevel;
  public $display_order;
  public $userstatus_id;
  public $divisionHeadCount;

  public $userdivision;

  protected $rules = [
    'user.department_id' => 'required',
    'user.division_id' => 'required',
    'user.name' => 'required',
    'user.contactno' => 'required',
    'user.gender' => 'required',
    'user.status' => 'required',
];


  public function updated($propertyName)
  {
    $this->validateOnly($propertyName);
  }

  public function mount()
  {
    $this->departments = Department::all();
    $this->divisions = Division::all();
    $this->constituencies = Constituency::all();
    $this->dzongkhags = Dzongkhag::all();
    $this->divisionHeadCount = null;
    $this->userList = collect();
  }

  /**
   * Render page
   *
   * @return void
   */
  public function render()
  {
    $users = User::with('agency')->with('department')->with('division')->where('status',1)->orderBy('display_order', 'asc')->paginate(50);
    $this->roles = Role::all();
    $this->agencies = Agency::all();
    $this->positionlevels = PositionLevel::all();
    $this->positiontitles = PositionTitle::all();
    // if (isset($this->user->id)) {
    //   $this->userList = User::where('department_id', $this->user->department_id)->get();
    // }
    return view('livewire.admin.users.index', compact('users'));
  }


  /**
   * store  data
   *
   * @return void
   */
  public function store()
  {

    $this->validate();

    if (isset($this->user->id)) {
      $id = $this->user->id;
      $this->validate([
        'email' => "required|email:rfc,dns|unique:users,email, $id",
        'username' => "required|unique:users,username, $id",
      ]);
      if ($this->password) {
        $this->validate([
          'password' => 'required|min:6|confirmed',
        ]);
        $this->user->password = Hash::make($this->password);
      }
      $this->user->agency_id = 1;
      $this->user->dzongkhag_id = $this->dzongkhag_id;
      $this->user->constituency_id = $this->constituency_id;
      $this->user->positiontitle = $this->positiontitle;
      $this->user->positionlevel = $this->positionlevel;
      $this->user->empid = $this->empid;
      $this->user->cid = $this->cid;
      $this->user->email = $this->email;
      $this->user->username = $this->username;
      $this->user->display_order = $this->display_order;
      $this->user->userstatus_id = 1;

      $this->user->save();
      session()->flash('message', 'User successfully updated!');
    } else {
      $this->validate([
        'password' => 'required|min:6|confirmed',
        'email' => 'required|email:rfc,dns|unique:users,email',
        'username' => 'required|unique:users,username',
      ]);
      $userResult = User::create([
        'name' => $this->user['name'],
        'email' => $this->email,
        'username' => $this->username,
        'password' => Hash::make($this->password),
        'agency_id' => 1,
        'department_id' => $this->user['department_id'],
        'division_id' => $this->user['division_id'],
        'contactno' => $this->user['contactno'],
        'status' => $this->user['status'],
        'empid' => $this->empid,
        'cid' => $this->cid,
        'positiontitle' => $this->positiontitle,
        'positionlevel' => $this->positionlevel,
        'gender' => $this->user['gender'],
        'display_order' => $this->display_order,
        'constituency_id' => $this->constituency_id,
        'dzongkhag_id' => $this->dzongkhag_id,
        'userstatus_id'=> 1
      ]);

      LeaveBalance::create([
        'user_id' => $userResult->id,
        'casual_leave' => 0,
        'earn_leave' => 0,
        'remarks' => '',
        'author' => Auth::user()->id
      ]);

      session()->flash('message', 'User successfully created!');
    }
    $this->reset(['user']);
    $this->confirmItemAdd = false;
    $this->password = null;
    $this->password_confirmation = null;
    return redirect()->route('admin.users');
  }

  /**
   * display edit modal (route - model binding)
   */
  public function showAssignRole(User $user)
  {
    $this->user = $user;
    $this->role_id = $user->roles->pluck('id');
    $this->confirmItemAdd = false;
    $this->assignRole = true;
    $this->subordinate = false;
    $this->supervisor = false;
  }

  /**
   * display edit modal (route - model binding)
   */
  public function assignRole()
  {
    $this->user->roles()->sync($this->role_id);
    $this->confirmItemAdd = false;
    $this->assignRole = false;
    $this->subordinate = false;
    $this->supervisor = false;
    $this->user = collect();
  }

  /**
   * supervisor
   * @param  mixed $user
   * @return void
   */
  public function supervisor(User $user)
  {
    $this->user = $user;
    $this->users_id = unserialize($user->serializeHeadId);

    $this->divisionHeadCount = $user->headId;

    $this->confirmItemAdd = false;
    $this->supervisor = true;
    $this->subordinate = false;
    $this->assignRole = false;
  }
  
  
  public function removesupervisor()
  {
    $user = User::find($this->user->id);
    $user->headId = null;
    $user->serializeHeadId= null;
    $user->save();
    return redirect()->route('admin.users');
  }

  /**
   * supervisorUpdate
   * @return void
   */
  public function supervisorUpdate()
  {
    $user = User::find($this->user->id);
    $headId = '';
    foreach ($this->users_id as $key => $value) {
      if ($value) {
        $headId = $key;
      }
    }
    $user->serializeHeadId = serialize($this->users_id);
    $user->headId = $headId;
    $user->save();

    $this->confirmItemAdd = false;
    $this->assignRole = false;
    $this->subordinate = false;
    $this->supervisor = false;
  }
  
  /**
   * subordinate
   * @param  mixed $user
   * @return void
   */
  public function subordinate(User $user)
  {
    $this->user = $user;
    $this->userList = User::orderBy('division_id', 'asc')->get();
    $this->users_id = unserialize($user->users_ids);
    $this->confirmItemAdd = false;
    $this->subordinate = true;
    $this->supervisor = false;
    $this->assignRole = false;
  }
  
  /**
   * subordinateUpdate
   * @return void
   */
  public function subordinateUpdate()
  {
    $this->users_ids_array = array();
    $users_ids_List = '';
    foreach ($this->users_id as $key => $value) {
      if ($value) {
        array_push($this->users_ids_array, $key);
        $users_ids_List .= $key . ',';
      }
    }
    $user = User::find($this->user->id);
    $user->users_ids = serialize($this->users_id);
    $user->users_ids_array = substr($users_ids_List, 0, -1);
    $user->save();
    $this->confirmItemAdd = false;
    $this->assignRole = false;
    $this->subordinate = false;
    $this->supervisor = false;
  }


  /**
   * display edit modal (route - model binding)
   */
  public function showEditModal(User $user)
  {
    $this->dzongkhag_id = $user->dzongkhag_id;
    $this->constituency_id = $user->constituency_id;
    $this->positionlevel = $user->positionlevel;
    $this->positiontitle = $user->positiontitle;
    $this->empid = $user->empid;
    $this->cid = $user->cid;
    $this->agency_id = $user->agency_id;
    $this->display_order = $user->display_order;
    $this->username = $user->username;
    $this->email = $user->email;
    $this->user = $user;

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
  public function destroy(User $user)
  {
    // $user->delete();
    $user->status = 0;
    $user->save();
    $this->confirmItemDeletion = false;
    session()->flash('message', 'user deleted successfully.');
    $this->reset(['user']);
    return redirect()->back();
  }

  /**
   * close  modal and reset the form 
   */
  public function closeModal()
  {
    $this->reset(['user']);
    $this->confirmItemAdd = false;
    $this->assignRole = false;
    $this->subordinate = false;
    $this->supervisor = false;
    $this->userList = collect();
  }


  /**
   * UpdatedUserDepartmentId
   * @param  mixed $depID
   * @return void
   */
  public function UpdatedUserDepartmentId($depID)
  {
    $this->divisions = Division::where("department_id", $depID)->get();
  }

  /**
   * UpdatedUserDivisionId
   * @param  mixed $id
   * @return void
   */
  public function UpdatedUserDivisionId($id)
  {
    if ($id == 5 || $id == 6) {
      $this->dzongkhags = Dzongkhag::orderBy('name', 'asc')->get();
    }
    else {
      $this->constituencies =  collect();
      $this->dzongkhags =  collect();
    }
  }
  
  /**
   * UpdatedDzongkhagId
   * @param  mixed $id
   * @return void
   */
  public function updatedDzongkhagId($id)
  {
      $this->constituencies =  Constituency::where('dzongkhag_id', $id)->get();
  }

  public function updatedUserdivision($id)
  {
    $this->userList = User::where('division_id', $id)->get();
  }
}
