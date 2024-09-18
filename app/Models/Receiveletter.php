<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Admin\Agency;
use App\Models\Admin\Department;
use App\Models\Admin\Division;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Receiveletter extends Model
{
    use HasFactory;

    protected $fillable = [
        'doc_id',
        'from_agency',
        'from_department',
        'from_division',
        'dak_number',
        'receive_date',
        'to_adressed',
        'to_agency_id',
        'to_department_id',
        'to_division_id',
        'to_subject',
        'file_index',
        'author'
    ];

    protected $dates = ['receive_date'];

  //Date accessor
  protected function receiveDate(): Attribute
  {
    return new Attribute(
      get: fn ($value) =>  Carbon::parse($value)->format('M-d-Y'),
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
        return $this->belongsTo(Division::class,'to_division_id','id');
    }
}
