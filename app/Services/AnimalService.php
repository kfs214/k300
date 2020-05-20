<?php
namespace App\Services;

use Carbon\Carbon;

class AnimalService{
  static function acode($birthday){
    $ref_date = Carbon::createFromDate('1921-12-26');
    $birthday = Carbon::createFromDate($birthday);
    $interval = $ref_date->diffInDays($birthday);
    $acode = $interval % 60;
    if($acode == 0){
      $acode = 60;
    }

    return $acode;

  }

  public function getLink($query){
    return '<a href="https://www.google.co.jp/search?q=動物占い+' . $query . '" target="_blank">' . $query . '</a>';
  }
}

 ?>
