<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Joinsittingdocument extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'directory_id', 'parliament_id', 'session_id', 'keyword', 'document', 'extension'];
}
