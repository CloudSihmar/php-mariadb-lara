<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Admin\Division;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'author',
        'ip_address',
        'inNotes',
        'outNotes',
        'status',
        'checkIn',
        'inStatus',
        'checkOut',
        'outStatus',
        'department_id',
        'division_id'
    ];

    public function user(){
        return $this->belongsTo(User::class,'author','id');
     }

    public function division(){
        return $this->belongsTo(Division::class,'division_id','id');
     }

     public function department(){
        return $this->belongsTo(Department::class,'department_id','id');
     }
    
}

