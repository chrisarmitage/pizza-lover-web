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

        if (!method_exists($route->getControllerName(), 'dispatch')) {
            throw new \Exception("Could not find controller: {$route->getControllerName()}");
        }

        /** @var Controller $controller */
        //$controller = new $controllerName;

        //$controllerResponse = $controller->dispatch();

        $response = new Response(
            "[Route: {$request->getPathInfo()}]"
                . "[Controller: {$route->getControllerName()}]"
                . "[Response: { $ controllerResponse}]",
            Response::HTTP_OK,
            [
                'content-type' => 'text/html',
            ]
        );

        $response->prepare($request);

        return $response;
    }

}
