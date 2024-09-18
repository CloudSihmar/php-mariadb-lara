<?php

namespace App\Models;

use App\Models\Admin\Agency;
use App\Models\LeaveBalance;
use App\Models\PositionTitle;
use App\Models\Admin\Division;
use App\Models\Admin\Department;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\RolesPermissionsTrait;
use App\Models\Admin\AttendanceStatus;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    use RolesPermissionsTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'users_ids',
        'agency_id',
        'department_id',
        'division_id',
        'status',
        'contactno',
        'empid',
        'cid',
        'positiontitle',
        'positionlevel',
        'gender',
        'display_order',
        'constituency_id',
        'dzongkhag_id',
        'userstatus_id'
    ];
 
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];


    public function agency(){
        return $this->belongsTo(Agency::class,'agency_id','id');
     }


    public function department(){
        return $this->belongsTo(Department::class,'department_id','id');
     }

    public function division(){
        return $this->belongsTo(Division::class,'division_id','id');
     }

     public function balanceleave(){
        return $this->belongsTo(LeaveBalance::class,'id','user_id');
     }

     public function userstatus(){
        return $this->belongsTo(AttendanceStatus::class,'userstatus_id','id');
     }

     public function title(){
        return $this->belongsTo(PositionTitle::class,'positiontitle','id');
     }
     
}
