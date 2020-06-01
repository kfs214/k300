<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Config;

class Animal extends Model
{
//  private $t12anames = ['ペガサス', '狼', 'こじか', '猿', 'チータ', '黒ひょう', 'ライオン', '虎', 'たぬき', '子守熊', 'ゾウ', 'ひつじ',];

  public function getWangelAttribute($value){
      return Animal::find($value)->aname;
  }


  public function getBdebilAttribute($value){
      return Animal::find($value)->aname;
  }


  public function getT60AnameAttribute($value){
      return $this->aname;
  }


  public function getAnameAttribute($value){
    if($this->type_shown % 2){
        return $value;
    }else{
        return Config::get('view.hidden');
    }
  }


  public function getT12AnameAttribute($value){
    if($this->type_shown % 4){
        return $value;
    }else{
        return Config::get('view.hidden');
    }
  }


  public function getT3AnameAttribute($value){
    if($this->type_shown % 8){
        return $value;
    }else{
        return Config::get('view.hidden');
    }
  }


/*敗北の記録
  public function orderByT12acode($direction = 'desc'){
    if( $direction == 'desc' ){
        $param = '';
        foreach( array_reverse($t12anames) as $t12aname){
          $param += $t12aname . ',';
        }
dd($param);
        return $this->find('all', ['order' => 'FIELD(t12aname,' . $t12acodes . ')']);
    }

  }
*/

}
