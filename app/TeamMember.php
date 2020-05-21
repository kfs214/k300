<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class TeamMember extends Model
{
    protected $guarded = [];

    protected $with = ['animal'];

    public function animal(){
        return $this->hasOne('App\Animal', 'id', 'acode');
    }

}
