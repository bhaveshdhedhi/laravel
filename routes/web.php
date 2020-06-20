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

Route::get('/indexajax', 'HomeController@indexAjax')->name('indexajax');

Route::get('/sendrequest', 'HomeController@sendRequest')->name('sendrequest');

Route::get('/blockuser', 'HomeController@blockUser')->name('blockuser');

Route::get('/acceptrequest', 'HomeController@acceptRequest')->name('acceptrequest');
