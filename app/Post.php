<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    //投稿者の情報を取得
    public function users(){
        return $this->hasOne('App\User', 'id');
    }
}
