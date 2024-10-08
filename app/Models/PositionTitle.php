<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PositionTitle extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'shortCode', 'author'];
}
