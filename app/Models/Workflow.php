<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Workflow extends Model
{
  use HasFactory;

  protected $fillable = ['name', 'content','author','created_date'];

  public function user(){
    return $this->belongsTo(User::class,'author','id');
  }
  
}
