<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;
use Illuminate\Contracts\Auth\Authenticatable;


class User extends Model implements Authenticatable
{   use \Illuminate\Auth\Authenticatable;
    use Notifiable;
    use Billable;

    public function chats(){
        return $this->hasMany('App\chat');
    }
    public function likes(){
        return $this->hasMany('App\like');
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'verifyToken',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function pessoa()
    {
        return $this->belongsTo('App\Pessoa');
    }

    public function isAdmin(){
        return (\Auth::check() && $this->isAdmin == 1);
    }

    public function isInst(){
        return (\Auth::check() && $this->isInst == 1);
    }

    
}

