<?php
namespace App\Services;

class AnimalService{
    public function getLink($query){
    return '<a href="https://www.google.co.jp/search?q=動物占い+' . $query . '" target="_blank">' . $query . '</a>';
  }
}

 ?>
