<?php

require __DIR__ . '/../vendor/autoload.php';

use Framework\App;
use Framework\Router\RestRouter;
use Framework\Router\RpcRouter;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();

$app = new App(new RestRouter());

$response = $app->processRequest($request);

$response->send();
