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

        $controllerResponse = $controller->dispatch();

        $response = new Response(
            "[Route: {$request->getPathInfo()}]<br />"
                . "[Method: {$request->getMethod()}]<br />"
                . "[Controller: {$route->getControllerName()}]<br />"
                . "[Response: {$controllerResponse}]",
            Response::HTTP_OK,
            [
                'content-type' => 'text/html',
            ]
        );

        $response->prepare($request);

        return $response;
    }

}
