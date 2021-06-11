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
    Route::get('/login', 'LoginController@create')->name('login.show');
    Route::post('/login', 'LoginController@store')->name('login.store');
    Route::delete('/logout', 'LoginController@destroy')->name('logout');

    Route::redirect('/', 'top')->name('home');
    
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/top', 'LoginController@top')->name('top');
        // Route::prefix('users')
        //     ->name('users.')
        //     ->group(function () {
        //         Route::get('/', 'UsersController@index')->name('list');
        //         Route::get('/create', 'UsersController@create')->name('create');
        //         Route::post('/', 'UsersController@store')->name('store');
        //         Route::get('/{user_id}/edit', 'UsersController@edit')->name('edit');
        //         Route::post('/{user_id}', 'UsersController@update')->name('update');
        //         Route::delete('/{user_id}', 'UsersController@destroy')->name('destroy');
        // });
    });
});
