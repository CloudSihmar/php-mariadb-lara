<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Agency extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'shortCode','author'];

    public function user(){
        return $this->belongsTo(User::class,'author','id');
     }

     
     public function getLowestPrice(){
      return "aaaa";
    }
    
    /**
     * department
     * @return void
     */
    public function departments()
    {
      return $this->hasMany(Department::class);
    }


  /**
   * divisions
   * @return void
   */
  public function divisions()
  {
    return $this->hasOneThrough(Division::class, Department::class);
  }
  
}
