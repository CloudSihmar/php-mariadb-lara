<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Joinsittingdocumentdirectory extends Model
{
    use HasFactory;
    protected $fillable = ['name'];


  /**
   * subfolder
   * @return void
   */
  public function subfolder()
  {
    return $this->hasMany(Jointsittingdocumentsubdirectory::class, 'directory_id');
  }
}
