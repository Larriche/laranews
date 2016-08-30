<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/home' , 'HomeController@index');

Route::get('/', 'HomeController@index');

Route::get('news/create','NewsController@create');

Route::get('news/edit/{news_item}' , 'NewsController@edit');

Route::get('news/{news_item}','NewsController@show');

Route::get('news/pdf_download/{id}','NewsController@getPDF');

Route::get('news/admin_view/{news_item}' , 'NewsController@adminView');

Route::get('news/make_unpublished/{news_item}' , 'NewsController@makeUnpublished');

Route::get('news/delete/{news_item}' , 'NewsController@destroy');

Route::post('news/','NewsController@store');

Route::post('news/edit/{news_item}' , 'NewsController@update');

Route::Controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
