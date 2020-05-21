<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
  public function getWangelAttribute($value){
      return Animal::find($value)->aname;
  }

  public function getBdebilAttribute($value){
      return Animal::find($value)->aname;
  }



}
