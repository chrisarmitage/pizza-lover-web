<?php

namespace Framework;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class App
{
    protected $router;

    /**
     * @param $router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function processRequest(Request $request)
    {
        $route = $this->router->getRouteForUrl($request->getPathInfo());

        $controller = (new ControllerResolver())->resolve($route->getControllerName());

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
