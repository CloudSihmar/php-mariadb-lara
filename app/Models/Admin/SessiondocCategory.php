<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessiondocCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

  /**
   * subfolder
   * @return void
   */
    public function subfolder()
    {
      return $this->hasMany(Sessiondocumentsubcategory::class, 'category_id');
    }

}
