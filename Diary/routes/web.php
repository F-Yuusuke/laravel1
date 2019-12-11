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
// routes/web.php
Route::get('/', 'DiaryController@index')->name('diary.index');

Route::get('diary/create', 'DiaryController@create')->name('diary.create'); // 投稿画面
Route::post('diary/create', 'DiaryController@store')->name('diary.store'); // 保存処理

// １　使わないからコメントアウト
// Route::get('/', function () {
//     return view('welcome');
// });
