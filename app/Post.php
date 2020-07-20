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

    //\nを<br>にして投稿取得
    public function getContentAttribte($value){
        $value = htmlspecialchars($value);
        dd($value);
        $order   = array("\r\n", "\n", "\r");
        $replace = '<br>';

        $value = str_replace($order, $replace, $value);

        return $value;
    }
}
