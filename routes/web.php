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

    //dashboard page route
    Route::get('/dashboard', 'Admin\DashboardController@index');

    //admin routes
    Route::get('admins','Admin\AdminController@index');
    Route::get('admin-show/{id}','Admin\AdminController@show');
    Route::get('admin-create','Admin\AdminController@create');
    Route::post('admin-store','Admin\AdminController@store');
    Route::get('admin-edit/{id}','Admin\AdminController@edit');
    Route::post('admin-update/{id}','Admin\AdminController@update');
    Route::delete('admin-delete/{id}','Admin\AdminController@delete');
    Route::get('admin-change/{id}','Admin\AdminController@change');
    Route::get('admin-changeTo-admin/{id}','Admin\AdminController@changeToAdmin');
    Route::get('admin-changeTo-makeupArtist/{id}','Admin\AdminController@changeToMakeupArtist');
    Route::get('admin-changeTo-user/{id}','Admin\AdminController@changeToUser');

    //makeup artist routes
    Route::get('makeupArtists','Admin\MakeupArtistController@index');
    Route::get('makeupArtist-show/{id}','Admin\MakeupArtistController@show');
    Route::get('makeupArtist-create','Admin\MakeupArtistController@create');
    Route::post('makeupArtist-store','Admin\MakeupArtistController@store');
    Route::get('makeupArtist-edit/{id}','Admin\MakeupArtistController@edit');
    Route::post('makeupArtist-update/{id}','Admin\MakeupArtistController@update');
    Route::delete('makeupArtist-delete/{id}','Admin\MakeupArtistController@delete');
    Route::get('makeupArtist-change/{id}','Admin\MakeupArtistController@change');
    Route::get('makeupArtist-changeTo-makeupArtist/{id}','Admin\MakeupArtistController@changeToAdmin');
    Route::get('makeupArtist-changeTo-makeupArtist/{id}','Admin\MakeupArtistController@changeToMakeupArtist');
    Route::get('makeupArtist-changeTo-user/{id}','Admin\MakeupArtistController@changeToUser');

    //user routes
    Route::get('users','Admin\UserController@index');
    Route::get('user-show/{id}','Admin\UserController@show');
    Route::get('user-create','Admin\UserController@create');
    Route::post('user-store','Admin\UserController@store');
    Route::get('user-edit/{id}','Admin\UserController@edit');
    Route::post('user-update/{id}','Admin\UserController@update');
    Route::delete('user-delete/{id}','Admin\UserController@delete');
    Route::get('user-change/{id}','Admin\UserController@change');
    Route::get('user-changeTo-makeupArtist/{id}','Admin\UserController@changeToAdmin');
    Route::get('user-changeTo-makeupArtist/{id}','Admin\UserController@changeToMakeupArtist');
    Route::get('user-changeTo-user/{id}','Admin\UserController@changeToUser');

    //phone routes
    Route::get('phones','Admin\PhoneController@index');
    Route::get('phone-show/{id}','Admin\PhoneController@show');
    Route::get('phone-create','Admin\PhoneController@create');
    Route::post('phone-store','Admin\PhoneController@store');
    Route::get('phone-edit/{id}','Admin\PhoneController@edit');
    Route::post('phone-update/{id}','Admin\PhoneController@update');
    Route::delete('phone-delete/{id}','Admin\PhoneController@delete');

    //social routes
    Route::get('socials','Admin\SocialController@index');
    Route::get('social-show/{id}','Admin\SocialController@show');
    Route::get('social-create','Admin\SocialController@create');
    Route::post('social-store','Admin\SocialController@store');
    Route::get('social-edit/{id}','Admin\SocialController@edit');
    Route::post('social-update/{id}','Admin\SocialController@update');
    Route::delete('social-delete/{id}','Admin\SocialController@delete');

    //area routes
    Route::get('areas','Admin\AreaController@index');
    Route::get('area-show/{id}','Admin\AreaController@show');
    Route::get('area-create','Admin\AreaController@create');
    Route::post('area-store','Admin\AreaController@store');
    Route::get('area-edit/{id}','Admin\AreaController@edit');
    Route::post('area-update/{id}','Admin\AreaController@update');
    Route::delete('area-delete/{id}','Admin\AreaController@delete');

    //city routes
    Route::get('cities','Admin\CityController@index');
    Route::get('city-show/{id}','Admin\CityController@show');
    Route::get('city-create','Admin\CityController@create');
    Route::post('city-store','Admin\CityController@store');
    Route::get('city-edit/{id}','Admin\CityController@edit');
    Route::post('city-update/{id}','Admin\CityController@update');
    Route::delete('city-delete/{id}','Admin\CityController@delete');

    //location routes
    Route::get('locations','Admin\LocationController@index');
    Route::get('location-show/{id}','Admin\LocationController@show');
    Route::get('location-create','Admin\LocationController@create');
    Route::post('location-store','Admin\LocationController@store');
    Route::get('location-edit/{id}','Admin\LocationController@edit');
    Route::post('location-update/{id}','Admin\LocationController@update');
    Route::delete('location-delete/{id}','Admin\LocationController@delete');

    //package routes
    Route::get('packages','Admin\PackageController@index');
    Route::get('package-show/{id}','Admin\PackageController@show');
    Route::get('package-create','Admin\PackageController@create');
    Route::post('package-store','Admin\PackageController@store');
    Route::get('package-edit/{id}','Admin\PackageController@edit');
    Route::post('package-update/{id}','Admin\PackageController@update');
    Route::delete('package-delete/{id}','Admin\PackageController@delete');

     //gallary routes
     Route::get('galleries','Admin\GalleryController@index');
     Route::get('gallery-show/{id}','Admin\GalleryController@show');
     Route::get('gallery-create','Admin\GalleryController@create');
     Route::post('gallery-store','Admin\GalleryController@store');
     Route::get('gallery-edit/{id}','Admin\GalleryController@edit');
     Route::post('gallery-update/{id}','Admin\GalleryController@update');
     Route::delete('gallery-delete/{id}','Admin\GalleryController@delete');
});
