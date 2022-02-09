<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Hyperf\HttpServer\Router\Router;

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@index');
Router::addRoute(['GET', 'HEAD'], '/grpc/index', 'App\Controller\GrpcController@index');
Router::addRoute(['GET', 'HEAD'], '/grpc/view', 'App\Controller\GrpcController@view');

Router::get('/favicon.ico', function () {
    return '';
});

Router::addServer('grpc', function () {
    Router::addGroup('/grpc.elixir', function () {
        Router::post('/indexClient', 'App\Controller\ElixirController@indexClient');
        Router::post('/viewClient', 'App\Controller\ElixirController@viewClient');
    });
});
