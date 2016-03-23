<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => 'web'], function(){

  Route::get('/dvds', 'Http\Controllers\DvdController@dvds');
  Route::get('/dvds/search', 'Http\Controllers\DvdController@search');
  Route::get('/dvds/create', 'Http\Controllers\DVDController@create');
  Route::post('/dvds', 'Http\Controllers\DVDController@createDVD');
  Route::get('/dvds/{id}', 'Http\Controllers\DVDReviewController@reviewPage');
  Route::post('/dvds/{id}', 'Http\Controllers\DVDReviewController@newReview');
  Route::get('/genres/{genre_name}/dvds', 'Http\Controllers\DVDController@genreDVDsPage');
//Google API route
  Route::get('API/google', 'Services\API\GoogleController@showMap');
});

Route::group(['prefix' => 'api/v1', 'namespace' => 'Http\Controllers\API'], function(){
  Route::get('genres', 'ApiController@index');
  Route::get('genres/{id}', 'ApiController@show');
  Route::get('dvds', 'ApiController@dvdsIndex');
  Route::get('dvds/{id}', 'ApiController@dvdsShow');
  Route::post('dvds', 'ApiController@dvdsStore');
});
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
