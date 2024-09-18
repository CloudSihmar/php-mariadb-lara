<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Committeesubfolder extends Model
{
    use HasFactory;
    protected $fillable = ['parliament_id','committee_id', 'foldername'];

}
