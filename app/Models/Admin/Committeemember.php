<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Committeemember extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'committee_id', 'parliament_id', 'committee_member_from','comm_designation', 'constituency'];

}
