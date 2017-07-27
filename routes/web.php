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



Route::group(['middleware' => 'auth'], function () {
    Route::resource('/', 'HomeController');

    Route::model('rate','App\Models\RateResponse');
    Route::model('reflect','App\Models\RateResponse');
    Route::model('translate','App\Models\RateResponse');
    Route::model('evaluate','App\Models\Evaluation');
    Route::model('rateassignment','App\Models\RateAssignment');

    Route::get('evaluate/getEvaluatorsForCompetency/{competency}', 'EvaluateController@getEvaluatorsForCompetency');
    Route::get('rate/getDescriptorForCompetency/{competency}', 'RateController@getDescriptorForCompetency');
    Route::get('rate/getExperiencesForCompetency/{competency}', 'RateController@getExperiencesForCompetency');
    Route::get('rate/getReflectionForRateResponse/{rate}', 'RateController@getReflectionForRateResponse');

    Route::resource('rate', 'RateController');
    Route::resource('translate', 'TranslateController');
    Route::resource('reflect', 'ReflectController');
    Route::resource('evaluate', 'EvaluateController');
    Route::resource('rateassignment', 'RateAssignmentController');

    Route::get("translate/{rate}/edit/{componentId}", "TranslateController@edit")->name("translate.edit");
    Route::get("rate/create/{rateAssignment?}", "RateController@create")->name("rate.create");

    Route::get("rate/{rate}/view/{authCode?}", "RateController@view")->name("rate.view");
    
    Route::post("rate/createCocurricular", "RateController@createCocurricular");


});
