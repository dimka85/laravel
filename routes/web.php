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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('info')->group(function () {
    Route::get('/about', function () {
        return 'Test';
    })->name('about');
    
    Route::get('/rules', function () {
        return 'Test';
    })->name('rules');
    
    Route::get('/roles', function () {
        return 'Test';
    })->name('roles');
});

Auth::routes();

Route::get('/auth/verify/{token}', 'Auth\RegisterController@verify')->name('verify');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    
    Route::namespace('Admin')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::name('admin.')->group(function () {
                Route::get('/', 'AdminController@index')->name('dashboard');
            });
        });
    });
});
