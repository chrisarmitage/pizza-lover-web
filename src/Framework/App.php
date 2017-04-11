<?php

namespace Framework;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class App
{
    protected $controllerNamespace = 'Framework\\Controller\\';

    public function processRequest(Request $request)
    {
        $controllerName = $this->getControllerForUrl($request->getPathInfo());

        /** @var Controller $controller */
        $controller = new $controllerName;

        $controllerResponse = $controller->dispatch();

        $response = new Response(
            "[Route: {$request->getPathInfo()}]"
                . "[Controller: {$controllerName}]"
                . "[Response: {$controllerResponse}]",
            Response::HTTP_OK,
            [
                'content-type' => 'text/html',
            ]
        );

        $response->prepare($request);

        return $response;
    }

    protected function getControllerForUrl($url)
    {
        $url = parse_url($url);

        preg_match_all("#/(?<controller>[\w\-]+)#", $url['path'], $matches);

        $controllerElements = array_map(
            function($url) {
                return str_replace(
                    ' ',
                    '',
                    ucwords(
                        str_replace(
                            '-',
                            ' ',
                            strtolower($url)
                        )
                    )
                );
            },
            $matches['controller']
        );

        $controllerName = $this->controllerNamespace . implode('\\', $controllerElements);

        if (!method_exists($controllerName, 'dispatch')) {
            throw new \Exception("Could not find controller: {$controllerName}");
        }

        return $controllerName;
    }
}
