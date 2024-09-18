<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sessiondocumentsubfolder extends Model
{
    use HasFactory;
    protected $fillable = ['parliament_id', 'session_id', 'category_id' ,'sub_category_id', 'name', 'keyword', 'document', 'extension'];
}
