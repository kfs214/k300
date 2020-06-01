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


    public function getAnameAttribute($value){
      if($this->type_shown % 2){
          return $this->animal()->first()->aname;
      }else{
          return Config::get('view.hidden');
      }
    }


    public function getRhythmAttribute($value){
      if($this->type_shown % 2){
          return $this->animal()->first()->rhythm;
      }else{
          return Config::get('view.hidden');
      }
    }


    public function getWangelAttribute($value){
      if($this->type_shown % 2){
          return $this->animal()->first()->wangel;
      }else{
          return Config::get('view.hidden');
      }
    }


    public function getBdebilAttribute($value){
      if($this->type_shown % 2){
          return $this->animal()->first()->bdebil;
      }else{
          return Config::get('view.hidden');
      }
    }


    public function getT12AnameAttribute($value){
      if($this->type_shown % 4){
          return $this->animal()->first()->t12aname;
      }else{
          return Config::get('view.hidden');
      }
    }


    public function getT3AnameAttribute($value){
      if($this->type_shown % 8){
          return $this->animal()->first()->t3aname;
      }else{
          return Config::get('view.hidden');
      }
    }


    public function getShownUnameAttribute($value){
      if($this->name_shown){
          return $this->uname;
      }else{
          return Config::get('view.hidden');
      }
    }
}
