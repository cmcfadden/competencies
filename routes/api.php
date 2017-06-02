<?php

use CloudCreativity\LaravelJsonApi\Routing\ApiGroup as Api;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


JsonApi::api('v1', 
	['namespace' => 'Api',
    'prefix' => 'v1',
    'as' => 'api-v1::'], 
	function ($api, $router) {
    $api->resource('competency', ['only' => ['index', 'read'], 'has-many' => ['descriptor-traits'=>['only' => ['related', 'read']], 'levels'=>['only' => ['related', 'read']], 'descriptors'=>['only' => ['related', 'read']]]]);
    $api->resource('descriptor-trait', ['only' => ['index', 'read'], 'has-one' => ['competency'=>['only' => ['related', 'read']]]]);
    $api->resource('level', ['only' => ['index', 'read'], 'has-one' => ['competency'=>['only' => ['related', 'read']]], 'has-many'=>['descriptors'=>['only' => ['related', 'read']]]]);
    $api->resource('descriptor', ['only' => ['index', 'read'], 'has-one' => ['competency'=>['only' => ['related', 'read']], 'level'=>['only' => ['related', 'read']], 'descriptor_trait'=>['only' => ['related', 'read']]]]);
});