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


// 一覧以外のページはログインしていないと表示(実行)できないように変更
Route::group(['middleware' => 'auth'], function() {
    Route::get('diary/create', 'DiaryController@create')->name('diary.create');
    Route::post('diary/create', 'DiaryController@store')->name('diary.create');
    
    Route::get('diary/{diary}/edit', 'DiaryController@edit')->name('diary.edit');
    Route::put('diary/{diary}/update', 'DiaryController@update')->name('diary.update');
    
    Route::delete('diary/{diary}/delete', 'DiaryController@destroy')->name('diary.destroy');
    Route::post('diary/{id}/like', 'DiaryController@like');
    Route::post('diary/{id}/dislike', 'DiaryController@dislike');    
});

Auth::routes();



Route::get('diary/create', 'DiaryController@create')->name('diary.create'); // 投稿画面
Route::post('diary/create', 'DiaryController@store')->name('diary.store'); // 保存処理
Route::delete('diary/{diary}/delete', 'DiaryController@destroy')->name('diary.destroy'); // 削除処理
Route::get('diary/{diary}/edit', 'DiaryController@edit')->name('diary.edit'); // 編集画面
Route::put('diary/{diary}/update', 'DiaryController@update')->name('diary.update'); //更新処理

// １　使わないからコメントアウト
// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// 必要ないため削除
// Route::get('/home', 'HomeController@index')->name('home');
