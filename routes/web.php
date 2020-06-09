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

Route::prefix('home')->middleware('verified')->as('home.')->group(function(){
  Route::get('', 'HomeController@index')->name('mypage');
  Route::post('', 'HomeController@updateIndividualSettings');
  Route::get('settings', 'HomeController@showSettings')->name('settings');
  Route::post('settings', 'HomeController@updateGeneralSettings');
});

Route::as('simple.')->group(function(){
  Route::get('simple', 'SimpleController@showSimpleForm')->name('form');
  Route::post('simple', 'SimpleController@result');
});

Route::prefix('team')->middleware('verified')->as('team.')->group(function(){
  Route::get('', 'TeamController@index')->name('index');
  Route::post('', 'TeamController@index');
  Route::post('add', 'TeamController@store')->name('add');
});

//掲示板機能
Route::prefix('boards')->as('boards.')->group(function(){
  //板一覧（認証不要）
  Route::get('', 'BoardsController@index')->name('index');

  //その他板系（要認証）
  Route::middleware('verified')->group(function(){
    Route::get('create', 'BoardsController@showCreateBoardForm')->name('create');
    Route::post('create', 'BoardsController@validateCreateBoard');
    Route::get('confirm', 'BoardsController@showConfirmBoard')->name('confirm');
    Route::post('confirm', 'BoardsController@storeBoard');
  });

  //投稿メッセージ系
  Route::prefix('{shown_id}')->as('board.')->middleware('joined')->group(function(){
    //投稿・メンバーの閲覧（認証不要）
    Route::get('', 'BoardsController@showBoard')->name('index');
    Route::get('members', 'BoardsController@showMembers')->name('members');
    Route::post('members', 'BoardsController@showMembers');

    //その他投稿メッセージ系（要認証）
    Route::middleware('verified')->group(function(){
      Route::post('', 'BoardsController@validateMessage');
      Route::get('confirm', 'BoardsController@showConfirmMessage')->name('confirm');
      Route::post('confirm', 'BoardsController@storeMessage');
      Route::get('leave', 'BoardsController@showConfirmLeave')->name('leave');
      Route::post('leave', 'BoardsController@leave');
    });
  });

  //joinだけは非公開掲示板でもjoined不要
  Route::middleware('verified')->prefix('{shown_id}')->as('board.')->group(function(){
    Route::get('join', 'BoardsController@showConfirmJoin')->name('join');
    Route::post('join', 'BoardsController@join');
  });
});

//メッセージ機能
Route::prefix('letters')->as('letters.')->middleware('verified')->group(function(){
  Route::get('', 'LettersController@inbox')->name('inbox');
  Route::post('', 'LettersController@inbox');
  Route::get('sent', 'LettersController@sent')->name('sent');
  Route::post('sent', 'LettersController@sent');
  Route::get('form/{to_user_id}', 'LettersController@showForm')->name('form');
  Route::post('form/{to_user_id}', 'LettersController@validateLetter');
  Route::get('confirm', 'LettersController@confirm')->name('confirm');
  Route::post('confirm', 'LettersController@storeLetter');
  Route::get('letter/{letter}', 'LettersController@showLetter')->name('letter');
});
