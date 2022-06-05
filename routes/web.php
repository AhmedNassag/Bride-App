<?php

use Illuminate\Support\Facades\Auth;
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


Route::group(['middleware'=>['auth','admin']],function () {

    Route::get('/dashboard', 'Admin\DashboardController@index');

    //admin routes
    Route::get('/admins','Admin\AdminController@index');
    Route::get('/admin-create','Admin\AdminController@create');
    Route::post('/admin-store','Admin\AdminController@store');
    Route::get('/admin-edit/{id}','Admin\AdminController@edit');
    Route::put('/admin-update/{id}','Admin\AdminController@update');
    Route::delete('/admin-delete/{id}','Admin\AdminController@delete');

    //makeup artist routes
    Route::get('/makeupArtists','Admin\MakeupArtistController@index');
    Route::get('/makeupArtist-create','Admin\MakeupArtistController@create');
    Route::post('/makeupArtist-store','Admin\MakeupArtistController@store');
    Route::get('/makeupArtist-edit/{id}','Admin\MakeupArtistController@edit');
    Route::put('/makeupArtist-update/{id}','Admin\MakeupArtistController@update');
    Route::delete('/makeupArtist-delete/{id}','Admin\MakeupArtistController@delete');

    //user routes
    Route::get('/users','Admin\UserController@index');
    Route::get('/user-create','Admin\UserController@create');
    Route::post('/user-store','Admin\UserController@store');
    Route::get('/user-edit/{id}','Admin\UserController@edit');
    Route::put('/user-update/{id}','Admin\UserController@update');
    Route::delete('/user-delete/{id}','Admin\UserController@delete');
});
