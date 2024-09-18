<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceReport extends Model
{
    use HasFactory;
    public $table = "view_attendance_records";


  public function user(){
    return $this->belongsTo(User::class,'UserId','id');
  }
}
