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


Route::name('login')->get("login", '\StudentAffairsUwm\Shibboleth\Controllers\ShibbolethController@emulateLogin');

Route::group(['middleware' => 'web'], function () {
    Route::name('shibboleth-login')->get('/shibboleth-login', 'StudentAffairsUwm\Shibboleth\Controllers\ShibbolethController@login');
    Route::name('shibboleth-authenticate')->get('/shibboleth-authenticate', 'StudentAffairsUwm\Shibboleth\Controllers\ShibbolethController@idpAuthenticate');
    Route::name('shibboleth-logout')->get('/shibboleth-logout', 'StudentAffairsUwm\Shibboleth\Controllers\ShibbolethController@destroy');
});
Route::group(['middleware' => 'web'], function () {
    Route::get('emulated/idp', 'StudentAffairsUwm\Shibboleth\Controllers\ShibbolethController@emulateIdp');
    Route::post('emulated/idp', 'StudentAffairsUwm\Shibboleth\Controllers\ShibbolethController@emulateIdp');
    Route::get('emulated/login', 'StudentAffairsUwm\Shibboleth\Controllers\ShibbolethController@emulateLogin');
    Route::get('emulated/logout', 'StudentAffairsUwm\Shibboleth\Controllers\ShibbolethController@emulateLogout');
});



Route::resource('/', 'HomeController');

Route::group(['middleware' => 'auth'], function () {
	Route::get('rate/capture', 'RateController@capture');
	Route::get('rate/{rate}/prepare', 'RateController@prepare');

    Route::get('evaluate/getEvaluatorsForCompetency/{competency}', 'EvaluateController@getEvaluatorsForCompetency');
	Route::get('rate/getDescriptorForCompetency/{competency}', 'RateController@getDescriptorForCompetency');

	Route::resource('rate', 'RateController');
	Route::resource('evaluate', 'EvaluateController');
});