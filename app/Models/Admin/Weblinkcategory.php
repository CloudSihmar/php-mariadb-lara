<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weblinkcategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];


    /**
     * category
     * @return void
     */
    public function weblink()
    {
      return $this->hasMany(Weblink::class);
    }
}
