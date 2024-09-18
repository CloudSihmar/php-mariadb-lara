<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Carbon\Carbon;

class Holiday extends Model
{
    use HasFactory;
    protected $fillable = ['holiday_date', 'shortCode','year','author'];


    protected $dates = ['holiday_date'];

    //Date accessor
    protected function holidayDate(): Attribute
    {
    return new Attribute(
        get: fn ($value) =>  Carbon::parse($value)->format('M-d-Y')
    );
    }

    public function user(){
        return $this->belongsTo(User::class, 'author','id');
     }
}
