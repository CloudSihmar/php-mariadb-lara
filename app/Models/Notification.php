<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'fid',
        'forward_to',
        'flag',
        'route',
        'author',
        'message'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'author', 'id');
    }

    public function forwardto(){
        return $this->belongsTo(User::class, 'forward_to', 'id');
    }

}
