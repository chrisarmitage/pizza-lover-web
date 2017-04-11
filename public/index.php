<?php

require __DIR__ . '/../vendor/autoload.php';

use Framework\App;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();

$app = new App();

$response = $app->processRequest($request);

$response->send();
