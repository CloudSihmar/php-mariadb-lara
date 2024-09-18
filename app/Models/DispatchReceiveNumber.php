<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DispatchReceiveNumber extends Model
{
    use HasFactory;
    
    protected $fillable = ['dORr', 'dr_num','year','author'];

    public function user(){
        return $this->belongsTo(User::class, 'author','id');
     }

}
