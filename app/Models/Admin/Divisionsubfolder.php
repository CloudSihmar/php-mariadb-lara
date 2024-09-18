<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisionsubfolder extends Model
{
    use HasFactory;
    protected $fillable = ['division_id', 'foldername'];
}
