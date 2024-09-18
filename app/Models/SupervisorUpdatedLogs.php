<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupervisorUpdatedLogs extends Model
{
    use HasFactory;
    protected $fillable = ['old_headId','new_headId','user_id', 'fromdate','todate','remarks','author'];
}
