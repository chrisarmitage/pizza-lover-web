<?php

declare(strict_types=1);

namespace Framework;

use Auryn\Injector;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class App
{
    /**
     * @var Router
     */
    protected $router;

    /**
     * @var ControllerResolver
     */
    protected $controllerResolver;

    /**
     * @var Injector
     */
    protected $container;

    /**
     * @param Router             $router
     * @param ControllerResolver $controllerResolver
     * @param Injector           $container
     */
    public function __construct(Router $router, ControllerResolver $controllerResolver, Injector $container)
    {
        $this->router = $router;
        $this->controllerResolver = $controllerResolver;
        $this->container = $container;
    }

    public function processRequest(Request $request)
    {
        $route = $this->router->getRouteForUrl($request->getPathInfo());

        $this->container->share($route);

        $controller = $this->controllerResolver->resolve($route->getControllerName());

        $controllerResponse = $controller->dispatch($route);

        $response = new Response(
            json_encode($controllerResponse),
            Response::HTTP_OK,
            [
                'content-type' => 'application/json',
            ]
        );

        $response->prepare($request);

        return $response;
    }

}
