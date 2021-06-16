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

    Route::redirect('/', 'users')->name('home');
    
    Route::group(['middleware' => 'auth'], function () {
        Route::prefix('users')
            ->name('users.')
            ->group(function () {
                Route::get('/', 'UserController@index')->name('list');                 // 一覧画面表示
                Route::get('/create', 'UserController@create')->name('create');        // 作成画面表示
                Route::post('/', 'UserController@store')->name('store');               // 作成
                Route::get('/{user_id}/edit', 'UserController@edit')->name('edit');    // 更新画面表示
                // Route::patch('/{user_id}', 'UserController@update')->name('update');    // 更新
                // Route::delete('/{user_id}', 'UserController@destroy')->name('destroy');// 削除
        });
    });
});
