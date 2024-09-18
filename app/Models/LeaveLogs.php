<?php

namespace App\Models;

use App\Models\Admin\Leavecategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LeaveLogs extends Model
{
    use HasFactory;
    protected $fillable = [
        'agency_id',
        'department_id',
        'division_id',
        'user_id',
        'timeIn',
        'fromdate',
        'todate',
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
