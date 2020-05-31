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

Route::get('', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::prefix('home')->middleware('auth')->as('home.')->group(function(){
  Route::get('', 'HomeController@index')->name('mypage');
  Route::post('', 'HomeController@updateIndividualSettings');
  Route::get('settings', 'HomeController@showSettings')->name('settings');
  Route::post('settings', 'HomeController@updateGeneralSettings');
});

Route::as('simple.')->group(function(){
  Route::get('simple', 'SimpleController@showSimpleForm')->name('form');
  Route::post('simple', 'SimpleController@result');
});

Route::prefix('team')->middleware('auth')->as('team.')->group(function(){
  Route::get('', 'TeamController@index')->name('index');
  Route::post('', 'TeamController@index');
  Route::post('add', 'TeamController@store')->name('add');
});

//掲示板機能
Route::prefix('boards')->as('boards.')->group(function(){
  //板一覧（認証不要）
  Route::get('', 'BoardsController@index')->name('index');

  //その他板系（要認証）
  Route::get('create', 'BoardsController@showCreateBoardForm')->name('create');
  Route::post('create', 'BoardsController@validateCreateBoard');
  Route::get('confirm', 'BoardsController@showConfirmBoard')->name('confirm');
  Route::post('confirm', 'BoardsController@storeBoard');

  //投稿メッセージ系
  Route::prefix('{id}')->as('board.')->group(function(){
    //投稿・メンバーの閲覧（認証不要）
    Route::get('', 'BoardsController@showBoard')->name('index');
    Route::get('members', 'BoardsController@showMembers')->name('members');

    //その他投稿メッセージ系（要認証）
    Route::middleware('auth')->group(function(){
      Route::post('', 'BoardsController@validateMessage');
      Route::get('confirm', 'BoardsController@showConfirmMessage')->name('confirm');
      Route::post('confirm', 'BoardsController@storeMessage');
      Route::get('join', 'BoardsController@showConfirmJoin')->name('join');
      Route::post('join', 'BoardsController@join');
      Route::get('leave', 'BoardsController@showConfirmLeave')->name('leave');
      Route::post('leave', 'BoardsController@leave');
    });


  });
});
