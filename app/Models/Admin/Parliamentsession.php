<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parliamentsession extends Model
{
    use HasFactory;
    protected $fillable = ['parliament_id','name', 'shortCode'];
}
