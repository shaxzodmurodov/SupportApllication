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
Auth::routes();

Route::group([
    'namespace' => 'Users',
    'middleware' => 'isUser',
], function () {
    Route::get('/', 'MainController@index')->name('index');
    Route::group([
        'middleware' => ['auth'],
        'prefix' => 'user',
        'as' => 'user.'
    ], function () {
        Route::resource('messages', 'MessagesController');
    });
});

Route::group([
    'namespace' => 'Admin',
    'middleware' => ['auth', 'isManager'],
    'prefix' => 'admin',
    'as' => 'admin.'
], function () {
    Route::resource('messages', 'MessagesController');
    Route::get('/index', 'MainController@index')->name('index');
});
