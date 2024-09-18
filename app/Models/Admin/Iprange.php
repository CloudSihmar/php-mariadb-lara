<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iprange extends Model
{
    use HasFactory;
    protected $fillable = ['start_ip', 'end_ip'];
}
