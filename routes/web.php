<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'web'], function () {
    Route::get('/login', 'LoginController@create')->name('login.show');     // ログイン画面表示
    Route::post('/login', 'LoginController@store')->name('login.store');    // ログイン処理
    Route::delete('/logout', 'LoginController@destroy')->name('logout');    // ログアウト処理

    Route::redirect('/', 'top')->name('home');
    
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/top', 'LoginController@top')->name('top'); // トップページ表示（仮）
        // Route::prefix('users')
        //     ->name('users.')
        //     ->group(function () {
        //         Route::get('/', 'UsersController@index')->name('list');                 // 一覧画面表示
        //         Route::get('/create', 'UsersController@create')->name('create');        // 作成画面表示
        //         Route::post('/', 'UsersController@store')->name('store');               // 作成処理
        //         Route::get('/{user_id}/edit', 'UsersController@edit')->name('edit');    // 更新画面表示
        //         Route::post('/{user_id}', 'UsersController@update')->name('update');    // 更新処理
        //         Route::delete('/{user_id}', 'UsersController@destroy')->name('destroy');// 削除処理
        // });
    });
});
