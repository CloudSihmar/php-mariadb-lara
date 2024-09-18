<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug'];

    /**
     * users
     * @return void
     */
    public function users()
    {
      return $this->belongsToMany(User::class, 'user_permissions');
    }
      
    /**
     * roles
     *
     * @return void
     */
    public function roles()
    {
      return $this->belongsToMany(Role::class, 'roles_permissions');
    }
}
