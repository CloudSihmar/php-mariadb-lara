<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jointsittingsubdocument extends Model
{
    use HasFactory;
    protected $fillable = ['parliament_id', 'session_id', 'directory_id', 'sub_directory_id',  'name', 'keyword', 'document', 'extension'];
}
