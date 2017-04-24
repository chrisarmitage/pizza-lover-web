<?php

require __DIR__ . '/../vendor/autoload.php';

use Framework\App;
use Framework\Router\RestRouter;
use Framework\Router\RpcRouter;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();

$container = new \Auryn\Injector();

$container->share($container);

$container->alias(\Framework\Router::class, RestRouter::class);

$app = $container->make(App::class);

$response = $app->processRequest($request);

$response->send();
