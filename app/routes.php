<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@showMain');

Route::get('/sample', 'HomeController@showSample');
Route::get('/minions', 'HomeController@showMinions');
Route::get('/lipstick', 'HomeController@showLipstick');

Route::get('/{prefix}/buy', 'BuyController@showBuy');
Route::post('/{prefix}/submit', 'BuyController@submit');

Route::get('/report', 'BuyController@showReport');