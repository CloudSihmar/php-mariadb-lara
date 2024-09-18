<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Act extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'file_index', 'keyword', 'document', 'extension'];
}
