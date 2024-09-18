<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sessiondocumentsubcategory extends Model
{
    use HasFactory;
    protected $fillable = ['parliament_id','session_id', 'category_id','name'];
}
