<?php

require __DIR__ . '/../vendor/autoload.php';
use \App\Utils\View;
use \WilliamCosta\DotEnv\Environment;
use \WilliamCosta\DatabaseManager\Database;
use \App\http\Middleware\Queue as MiddlewareQueue;


Environment::load(__DIR__ . '/../');

Database::config(
    getenv('DB_HOST'),
    getenv('DB_NAME'),
    getenv('DB_USER'),
    getenv('DB_PASS'),
    getenv('DB_PORT'),
);

define('URL', getenv('URL'));

View::init([
    'URL' => URL,
]);

//Mapeamento de middlewares
MiddlewareQueue::setMap([
    'maintenance' => \App\Http\Middleware\Maintenance::class,
    'required-admin-logout' => \App\Http\Middleware\RequireAdminLogout::class,
    'required-admin-login' => App\Http\Middleware\RequireAdminLogin::class,
    'api' => App\Http\Middleware\Api::class
]);




//SETA OS MIDDLEWARES PADRÃO
MiddlewareQueue::setDefault([
    'maintenance'
]);