<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Weblink extends Model
{
  use HasFactory;
  
  protected $fillable = ['name', 'weblinkcategory_id', 'url'];

    
  /**
   * category
   * @return void
   */
  public function category()
  {
    return $this->belongsTo(weblink::class);
  }
}
