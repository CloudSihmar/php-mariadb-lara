<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\RolesPermissionsTrait;

class Role extends Model
{
  use HasFactory;
  use RolesPermissionsTrait;
  
  protected $fillable = ['name','slug'];
  
  /**
   * permissions
   * @return void
   */
  public function permissions()
  {
    return $this->belongsToMany(Permission::class, 'roles_permissions');
  }

  
  /**
   * users
   * @return void
   */
  public function users()
  {
    return $this->belongsToMany(User::class, 'user_roles');
  }
}
