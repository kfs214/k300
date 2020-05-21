<?php
namespace App\Http\Composers;

use Illuminate\View\View;
use App\Animal;
//not used
class AnimalComposer{
  public function compose(View $view){
    $wangel = Animal::find($view->animal->wangel)->aname;
    $bdebil = Animal::find($view->animal->bdebil)->aname;
    $view->animal->wangel = $wangel;
    $view->animal->bdebil = $bdebil;
  }
}
