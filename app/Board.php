<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $guarded = [];

    //参加しているユーザーを取得
    public function users(){
        return $this->belongsToMany('App\User', 'user_board')->withPivot('notify');
    }


    //投稿を取得
    public function posts(){
        return $this->hasMany('App\Post');
    }
}
