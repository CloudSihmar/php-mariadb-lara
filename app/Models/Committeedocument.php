<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Committeedocument extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'committee_id', 'parliament_id', 'keyword','document', 'extension'];
}
