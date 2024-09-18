<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leavecategory extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'leaveCode','shortCode', 'author'];
    protected $table = 'leave_categories';
}
