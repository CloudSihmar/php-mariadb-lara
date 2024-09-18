<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secretariatdocument extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'parliament_id','division_id', 'file_index', 'keyword', 'document', 'extension'];
}
