<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Leavecategory;

class AttendanceLogs extends Model
{
    use HasFactory;
    protected $fillable = [
        'agency_id',
        'department_id',
        'division_id',
        'user_id',
        'timeIn',
        'dated',
        'leave_category_id'
    ];

    protected $casts = [
        'timeIn' => 'date:hh:mm'
    ];

  public function leavetype(){
    return $this->belongsTo(Leavecategory::class,'leave_category_id','id');
  }
}
