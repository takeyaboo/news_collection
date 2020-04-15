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

// Route::middleware('auth:api', 'throttle:60,1')->group(function () {
Route::group(['middleware' => 'auth'], function() {
  Route::get('/home/{id?}', 'HomeController@index')->name('home');
  Route::get('/news', 'NewsController@index');
  Route::get('/news_search', 'NewsController@search');
  Route::get('/news_list/{id?}', 'NewsController@news_list');
  Route::post('/news_list', 'NewsController@news_list');
  Route::post('/news_list/store', 'NewsController@news_list_store');
  Route::get('/news_list/all/{id}', 'NewsController@news_list_all');
  Route::resource('/category', 'CategoryController');
  Route::resource('/word', 'WordController');
  Route::get('/word_vue/{id}', 'Ajax\WordController@index');
  Route::get('/ajax/word/{id}', 'Ajax\WordController@word_vue');
  Route::get('/news_vue/{id}', 'Ajax\NewsController@index');
  Route::get('/ajax/news/{id}', 'Ajax\NewsController@news_vue');
  Route::get('/ajax/top/{id}', 'Ajax\TopController@index');


});
