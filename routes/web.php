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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// route1

Route::resource('/posts', 'PostController');

// Route::prefix('free-zone')->group(function () {

//     Route::get('hello', 'TestController@guest')->name('hello_free');
    
//     // Route post
//     Route::get('/post', 'TestController@index')->name('home');
// });

// // route2
// Route::prefix('restrict-zone')->middleware('auth')->group(function () {
//     Route::get('hello', 'TestController@logged')->name('private');

//     Route::resource('post', 'TestController');

// });


