<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/nasabah', 'NasabahController@index');
$router->post('/nasabah/post', 'NasabahController@store');

$router->get('/transaction', 'TransactionController@index');
$router->post('/transaction/post', 'TransactionController@create');
$router->post('/transaction/bydate', 'TransactionController@store');

$router->get('/point', 'PointController@index');