<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Admin\Leavecategory;
use App\Models\Admin\LeaveStatus;
use App\Traits\IDGeneratorTrait;
use App\Models\Admin\Department;
use App\Models\Admin\Division;
use App\Models\Admin\Agency;
use Carbon\Carbon;

class Leave extends Model
{
  use HasFactory;

  use IDGeneratorTrait;

  protected $fillable = ['document','fromDate', 'toDate','leave_category_id','employeeRemarks','headRemarks',
  'agency_id','department_id','division_id','status','author','actionby'];

  public function user(){
    return $this->belongsTo(User::class,'author','id');
  }
  
  public function approve(){
    return $this->belongsTo(User::class,'actionby','id');
  }

  public function agency(){
    return $this->belongsTo(Agency::class,'agency_id','id');
  }
  
  public function department(){
      return $this->belongsTo(Department::class,'department_id','id');
  }

  public function division(){
      return $this->belongsTo(Division::class,'division_id','id');
  }

  public function leavetype(){
    return $this->belongsTo(Leavecategory::class,'leave_category_id','id');
  }

  public function leavestatus(){
    return $this->belongsTo(LeaveStatus::class,'status','id');
  }
  
}

