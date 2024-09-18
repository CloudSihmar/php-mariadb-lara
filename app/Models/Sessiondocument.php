<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sessiondocument extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'category_id','parliament_id', 'session_id', 'keyword', 'document','extension'];
}
