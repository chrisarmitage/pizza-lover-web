<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Framework\App;
use Framework\Router\RestRouter;
use Framework\Router\RpcRouter;
use Google\Cloud\Datastore\DatastoreClient;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();

$container = new \Auryn\Injector();

$container->share($container);

$container->alias(\Framework\Router::class, RpcRouter::class);


    $datastore = new DatastoreClient(
        [
            'projectId' => 'alpha-189510',
            //'keyFile' => json_decode(file_get_contents(__DIR__ . '/../../../7-2-alpha.json'), true),
        ]
    );
$container->share($datastore);


$app = $container->make(App::class);

$response = $app->processRequest($request);

$response->send();
