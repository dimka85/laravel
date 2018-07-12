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

Route::get('/', 'WelcomeController@index')->name('welcome');

Route::prefix('info')->group(function () {
    Route::get('/about', 'WelcomeController@about')->name('about');
    Route::get('/rules', 'WelcomeController@rules')->name('rules');
    Route::get('/roles', 'WelcomeController@roles')->name('roles');
});

Auth::routes();

Route::get('/auth/verify/{token}', 'Auth\RegisterController@verify')->name('verify');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    
    Route::namespace('Game')->group(function () {
        Route::prefix('game')->group(function () {
            Route::name('game.')->group(function () {
                Route::get('/start', 'GameController@start')->name('start');
                Route::get('/search', 'GameSearchController@index')->name('search');
                Route::get('/settings', 'GameController@settings')->name('settings');
                Route::get('/statistics', 'GameController@statistics')->name('statistics');
            });
        });
    });
    
    Route::namespace('Admin')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::name('admin.')->group(function () {
                Route::get('/', 'AdminController@index')->name('dashboard');
    
                Route::prefix('user')->group(function () {
                    Route::name('user.')->group(function () {
                        Route::get('/profile/{user}', 'AdminController@index')->name('profile');
                        Route::get('/statistics/{user}', 'AdminController@index')->name('statistics');
                    });
                });
            });
        });
    });
});
