<?php

namespace App\Traits;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Arr;

trait RolesPermissionsTrait
{
  /**
   *get permissions
   */
  public function getAllPermissions(array $permissions)
  {
    $permission_arr = Arr::flatten($permissions);
    return Permission::whereIn('slug', $permission_arr)->get();
  }

  /**
   * check has permission of the user
   */
  public function hasPermission($permission)
  {
    return (bool) $this->permissions->where('slug', $permission->slug)->count();
  }

  /**
   *permissions 
   */
  public function permissions()
  {
    return $this->belongsToMany(Permission::class, 'users_permissions');
  }


  /**
   * roles
   */
  public function roles()
  {
    return $this->belongsToMany(Role::class,'users_roles');
  }

  /**
   * $roles
   */
  public function hasRole(...$roles)
  {
    foreach ($roles as $role) {
      if ($this->roles->contains('slug', $role)) {
        return true;
      }
    }
    return false;
  }


  /**
   * hasPermissionThroughRole
   */
  public function hasPermissionThroughRole($permissions)
  {
    foreach ($permissions->roles as $role) {
      if ($this->roles->contains($role)) {
        return true;
      }
    }
    return false;
  }


  /**
   * Check user permission through role
   */
  public function hasPermissionTo($permission)
  {
    return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
  }

  /**
   * givePermissionsTo
   */
  public function givePermissionsTo(...$permissions)
  {
    try {
      $permissions = $this->getAllPermissions($permissions);
      if ($permissions === null) {
        return $this;
      }
      $this->permissions()->attach($permissions);
      return $this;

    } catch (\Throwable $e) {
      session()->flash('error', 'Permissions error..try assigning again!!!');
    }
   
  }

  /**
   * hasAnyRole
   */
  public function hasAnyRole(string $role)
  {
    return null !== $this->roles()->where('name', $role)->first();
  }

  /**
   * deletePermissions
   */
  public function deletePermissions(...$permissions)
  {
    try {
      $permissions = $this->getAllPermissions($permissions);
      $this->permissions()->detach($permissions);
      return $this;
    } catch (\Throwable $e) {
      session()->flash('error', 'Permissions error..try deleting again!!!');
    }
  }

  /**
   * refreshPermissions
   */
  public function refreshPermissions(...$permissions)
  {
    $this->permissions()->detach();
    return $this->givePermissionsTo($permissions);
  }
  
}