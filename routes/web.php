<?php

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

Route::resource('/', 'HomeController');


Route::get('rate/capture', 'RateController@capture');
Route::get('rate/prepare', 'RateController@prepare');

Route::get('evaluate/getEvaluatorsForCompetency/{competency}', 'EvaluateController@getEvaluatorsForCompetency');

Route::resource('rate', 'RateController');
Route::resource('evaluate', 'EvaluateController');

