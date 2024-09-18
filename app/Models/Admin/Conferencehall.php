<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conferencehall extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug'];
}
