<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
//  private $t12anames = ['ペガサス', '狼', 'こじか', '猿', 'チータ', '黒ひょう', 'ライオン', '虎', 'たぬき', '子守熊', 'ゾウ', 'ひつじ',];

  public function getWangelAttribute($value){
      return Animal::find($value)->aname;
  }

  public function getBdebilAttribute($value){
      return Animal::find($value)->aname;
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
