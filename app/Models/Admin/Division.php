<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'shortCode','agency_id','department_id','status','author'];

    public function user(){
        return $this->belongsTo(User::class, 'author','id');
     }

    public function department(){
        return $this->belongsTo(Department::class,'department_id','id');
    }
}

