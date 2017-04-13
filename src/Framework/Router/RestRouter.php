<?php

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
    public function getRouteForUrl($url, $method = 'GET')
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

        $resourceName = $this->controllerNamespace . array_shift($resourceElements);
        $controllerType = $this->methodActions[$method];
        $resourceId = array_shift($matches['id']);

        if ($controllerType === 'Index' && $resourceId !== '') {
            $controllerType = 'Read';
        }
        $controllerName = $resourceName . '\\' . $controllerType;

        $nestedResources = [];
        foreach ($resourceElements as $key => $value) {
            $nestedResources[] = [
                'resource' => $value,
                'id' => isset($matches['id'][$key]) ? $matches['id'][$key] : null,
            ];
        }

        $route = new RestRoute($controllerName, $resourceId, $nestedResources);

        return $route;
    }
}
