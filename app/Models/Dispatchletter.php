<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Traits\IDGeneratorTrait;
use App\Models\Admin\Agency;
use App\Models\Admin\Department;
use App\Models\Admin\Division;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Dispatchletter extends Model
{
  use HasFactory;

  use IDGeneratorTrait;
  // use DispatchNumberGeneratorTrait;


  protected $fillable = [
    'doc_id',
    'from_agency_id',
    'from_department_id',
    'from_division_id',
    'dispatch_number',
    'issue_date',
    'to_adressed',
    'to_agency',
    'to_department',
    'to_division',
    'to_subject',
    'file_index',
    'author'
];

  protected $dates = ['issue_date'];

  //Date accessor
  protected function issueDate(): Attribute
  {
    return new Attribute(
      get: fn ($value) =>  Carbon::parse($value)->format('M-d-Y')
    );
  }


  public function user(){
    return $this->belongsTo(User::class,'author','id');
  }

  public function agency(){
    return $this->belongsTo(Agency::class,'from_agency_id','id');
  }

  public function department(){
      return $this->belongsTo(Department::class,'from_department_id','id');
  }

  public function division(){
      return $this->belongsTo(Division::class,'from_division_id','id');
  }

  public function forwardto(){
    return $this->belongsTo(Notification::class,'fid','id');
  }
}
