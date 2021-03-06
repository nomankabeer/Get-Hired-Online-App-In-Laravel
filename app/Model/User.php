<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    const adminRoleId = 1;
    const freelancerRoleId = 2;
    const clientRoleId = 3;

    const accountBlock = 1;
    const accountActive = 0;

    protected $fillable = [
        'name', 'email', 'password', 'role_id'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userDetail(){
        return $this->hasOne(FreelancerDetail::class ,  'user_id' , 'id' );
    }

    public function isFreelancer(){
        $status = false;
        if($this->role_id === self::freelancerRoleId){
            $status = true;
        }
        return $status;
    }
}
