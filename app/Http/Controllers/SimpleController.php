<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DateRequest;
use App\Services\AnimalService;
use App\Animal;

class SimpleController extends Controller
{
    public function showSimpleForm(){
      return view('home.simple');
    }

    public function result(DateRequest $request){
      $data = $request->validate([
        'birthday' => 'required|date_format:"Y-m-d"',
      ]);

      if(!session('bday_year')){
        session([
          'bday_year' => $request->bday_year,
          'bday_month' => $request->bday_month,
          'bday_day' => $request->bday_day,
        ]);
      }

      $acode = AnimalService::acode($request->birthday);
      $animal = Animal::find($acode);
      $birthday = $request->birthday;
      $title = '簡易診断';
      return view('home.index', compact('animal', 'birthday', 'title'));
    }
}
