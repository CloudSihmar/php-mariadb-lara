<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dzongkhag extends Model
{
    use HasFactory;

  protected $fillable = ['name','shortCode','author'];

}
