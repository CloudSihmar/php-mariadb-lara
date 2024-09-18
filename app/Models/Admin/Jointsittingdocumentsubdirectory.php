<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jointsittingdocumentsubdirectory extends Model
{
    use HasFactory;
    protected $fillable = ['parliament_id', 'session_id', 'directory_id','name'];
}
