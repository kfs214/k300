<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Animal;
use Config;

class User extends Authenticatable implements MustVerifyEmailContract
{
    use MustVerifyEmail, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uname', 'birthday', 'acode', 'comment', 'name_shown', 'type_shown', 'email', 'password', 'notify_posts', 'notify_users', 'notify_messages',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function animal(){
        return $this->hasOne('App\Animal', 'id', 'acode');
    }


    public function boards(){
        return $this->belongsToMany('App\Board', 'user_board')->withPivot('notify');
    }


    public function getShownUnameAttribute($value){
      if($this->name_shown){
          return $this->uname;
      }else{
          return Config::get('view.hidden');
      }
    }
}
