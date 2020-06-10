<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Animal;
use Config;
use Vinkla\Hashids\Facades\Hashids;

class User extends Authenticatable implements MustVerifyEmailContract
{
    use MustVerifyEmail, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uname', 'birthday', 'acode', 'comment', 'name_shown', 'type_shown', 'email', 'password', 'notify_posts', 'notify_users', 'notify_messages', 'birthday_shown',
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
    
    
    public function getLetterLinkAttribute($value){
      return '<a href="' . $this->getLetterUrlAttribute() . '" title="このユーザーにメッセージを送る">' . $this->profile . '</a>';
    }
    
    public function getLetterUrlAttribute($value){
      return route('letters.form', Hashids::encode($this->getKey()));
    }


    public function getShownUnameAttribute($value){
      if($this->name_shown){
          return $this->uname;
      }else{
          return Config::get('view.hidden');
      }
    }

    public function getShownAnameAttribute($value){
      if($this->type_shown % 2){
          return $this->animal()->first()->aname;
      }elseif($this->type_shown % 4){
          return $this->animal()->first()->t12aname;
      }elseif($this->type_shown % 8){
          return $this->animal()->first()->t3aname;
      }else{
          return Config::get('view.hidden_aname');
      }
    }
    
    
    public function getShownBirthdayAttribute($value){
        return $this->birthday_shown ? $this->birthday : Config::get('view.hidden');
    }


    public function getProfileAttribute($value){
      if($this->name_shown){
          $shown_uname = $this->uname . 'さん';
      }else{
          $shown_uname = Config::get('view.hidden');
      }

      return $shown_uname . '（' . $this->shown_aname . '）';
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
    
    
    public function letters(){
      return $this->hasMany('App\Letter', 'to_user_id', 'id');
    }
    
    
/*    public function from_user(){
      return $this->hasOneThrough(
          'App\User',
          'App\Letter',
          'to_user_id',
          'id',
          'id',
          'from_user_id'
      );
    }*/


    public function posts(){
        return $this->hasManyThrough(
          'App\Post',
          'App\Board',
          'id',
          'board_id',
          'id',
          'id'
        );
    }
}
