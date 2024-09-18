<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Committee extends Model
{
    use HasFactory;
    protected $fillable = ['parliament_id','name'];


  /**
   * committes
   * @return void
   */
  public function committes()
  {
    return $this->hasMany(Committeemember::class);
  }

  /**
   * committes
   * @return void
   */
  public function doctypes()
  {
    return $this->hasMany(Committeedoctype::class);
  }
  
}
