<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::as('simple.')->group(function(){
  Route::get('/simple', 'SimpleController@showSimpleForm')->name('form');
  Route::post('/simple', 'SimpleController@result');
});

Route::middleware('auth')->as('team.')->group(function(){
  Route::get('/team', 'TeamController@index')->name('index');
  Route::post('/team', 'TeamController@index');
  Route::post('/team/add', 'TeamController@store')->name('add');
});
