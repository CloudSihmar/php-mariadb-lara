<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Committeesubfolderdocument extends Model
{
    use HasFactory;
    protected $fillable = ['parliament_id', 'committee_id', 'sub_folder_id', 'name', 'keyword', 'document', 'extension'];
}
