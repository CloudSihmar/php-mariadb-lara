<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Admin\Department;

class LeaveBalance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'earn_leave',
        'casual_leave',
        'remarks',
        'author'
        ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function department(){
        return $this->belongsTo(Department::class,'department_id','id');
    }
}
