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

    \Illuminate\Support\Facades\App::setLocale('en');
    __('passwords.reset');
die("ends");
    die();
    return view('welcome');
});

Auth::routes();

Route::resource('advertisements', 'AdvertisementController')->only(['index', 'show']);
Route::resource('categories', 'CategoryController')->only(['index', 'show']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('advertisements', 'AdvertisementController')->only(['store', 'update', 'destroy']);
    Route::get('advertisements/{id}/messages/conversations/{groupId}', 'MessageController@conversation');
    Route::resource('advertisements/{id}/messages', 'MessageController')->only(['index', 'store']);
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::resource('categories', 'CategoryController');
});