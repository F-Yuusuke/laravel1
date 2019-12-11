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

// ２　追加 クラスを読んでいるRouteの中のgetを呼び出している
// Route::getこの書き方をするとnewしなくてもクラスを呼び出すことができる PHPのstaticメソッド、staticプロパティと言う
Route::get('/', 'DiaryController@index')->name('diary.index'); 

// １　使わないからコメントアウト
// Route::get('/', function () {
//     return view('welcome');
// });
