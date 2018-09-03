<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'isregular', 'isadmin', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin()
    {
        if($this->isadmin=='1' && $this->isregular == '0')
        return true;
    }

    public function isRegular()
    {
        if($this->isadmin =='0'  && $this->isregular=='1')
        return true;
    }

    public function isSuperAdmin()
    {
        if($this->isadmin=='1' && $this->isregular=='1')
        return true;
    }
}
