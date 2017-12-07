<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->post('login',['uses'=>'UserController@logAccount']);
$router->post('register',['uses'=>'UserController@register']);
$router->group(['prefix'=>'user'],function ()use ($router){
    $router->get('tel/{telephone}',['uses'=>'UserController@checkPhone']);
    $router->put('{username}',['uses'=>'UserController@updateUser']);
    $router->get('{username}',['uses'=>'UserController@getUser']);
});

$router->group(['prefix'=>'news'],function ()use($router){
    $router->get('{category}',['uses'=>'NewsController@getCategory']);
    $router->get('hots',['uses'=>'NewsController@hotNews']);
    $router->get('id',['uses'=>'NewsController@detail']);
});