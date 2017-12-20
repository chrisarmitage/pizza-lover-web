<?php

declare(strict_types=1);

namespace Framework\Router;

use Framework\Router;

class RestRouter implements Router
{
    protected $controllerNamespace = 'Framework\\Controller\\';

    protected $methodActions = [
        'GET' => 'Index',
        'POST' => 'Create',
        'PUT' => 'Update',
        'DELETE' => 'Delete',
    ];

    /**
     * @param string $url
     * @param string $method
     * @return RestRoute
     */
    public function getRouteForUrl($url, $method = 'GET') : RestRoute
    {
        $url = parse_url($url);

        preg_match_all("#/(?<resource>[\w\-]+)(?:/(?<id>[\w\-]+))?#", $url['path'], $matches);

        $resourceElements = array_map(
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
            $matches['resource']
        );

        $resourceName = $this->controllerNamespace . array_pop($resourceElements);
        $controllerType = $this->methodActions[$method];
        $resourceId = (count($matches['resource']) === count($matches['id']))
            ? array_pop($matches['id'])
            : null;

        if ($controllerType === 'Index' && $resourceId !== '') {
            $controllerType = 'Read';
        }
        $controllerName = $resourceName . '\\' . $controllerType;

        $nestedResources = [];
        foreach ($resourceElements as $key => $value) {
            $nestedResources[$value] = $matches['id'][$key];
        }

        $route = new RestRoute($controllerName, $resourceId, $nestedResources);

        return $route;
    }
}
