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

// just for admin users
Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'namespace' => 'admin'], function(){

    Route::get('/', 'MainController@index')->name('admin.index');
    Route::resource('/categories', 'CategoryController');
    Route::resource('/tags', 'TagController');
    Route::resource('/posts', 'PostController');
});

// just for guest users (if admin - redirect to home)
Route::group(['middleware' => 'guest'], function(){

    Route::get('/register', 'UserController@create')->name('register.create');
    Route::post('/register', 'UserController@store')->name('register.store');

    Route::get('/login', 'UserController@loginForm')->name('login.create');
    Route::post('/login', 'UserController@login')->name('login');
});

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/logout', 'UserController@logout')->name('logout')->middleware('auth');

