<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Agency;
use App\Models\User;


class Department extends Model
{
  use HasFactory;
  protected $fillable = ['name', 'shortCode', 'agency_id', 'author'];


  public function user()
  {
    return $this->belongsTo(User::class, 'author', 'id');
  }


  public function agency()
  {
    return $this->belongsTo(Agency::class, 'agency_id', 'id');
  }

  /**
   * divisions
   * @return void
   */
  public function divisions()
  {
    return $this->hasMany(Division::class);
  }
}
