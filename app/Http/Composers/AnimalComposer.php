<?php
namespace App\Http\Composers;

use Illuminate\View\View;

class HelloComposer{
  public function getAname(View $view){
    $animal->wangel = Animal::find($animal->wangel)->aname;
    $animal->bdebil = Animal::find($animal->bdebil)->aname;
  }
}
