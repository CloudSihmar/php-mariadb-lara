<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parliament extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'shortCode'];


  /**
   * parliamentsessions
   * @return void
   */
  public function parliamentsessions()
  {
    return $this->hasMany(Parliamentsession::class)->orderBy('created_at','desc');
  }

  /**
   * parliamentsessions
   * @return void
   */
  public function committees()
  {
    return $this->hasMany(Committee::class)->orderBy('created_at', 'asc');
  }
}
