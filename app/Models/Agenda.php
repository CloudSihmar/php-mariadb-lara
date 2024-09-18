<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Parliament;
use App\Models\Admin\Parliamentsession;

class Agenda extends Model
{
    use HasFactory;

  protected $fillable = ['doc_id','shortCode','parliament_id','session_id','author'];

  public function user(){
    return $this->belongsTo(User::class,'author','id');
  }

  public function parliament(){
      return $this->belongsTo(Parliament::class,'parliament_id','id');
  }

  public function session(){
      return $this->belongsTo(Parliamentsession::class,'session_id','id');
  }
}
