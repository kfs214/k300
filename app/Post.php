<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    //投稿者の情報を取得
    public function user(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }


    public function animal(){
        return $this->hasOneThrough(
          'App\Animal',
          'App\User',
          'acode',
          'id',
          'user_id',
          'id'
        );
    }
}
