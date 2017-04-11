<?php

namespace Framework\Router;

class RestRouter
{
    protected $controllerNamespace = 'Framework\\Controller\\';

    /**
     * @param $url
     * @return RestRoute
     */
    public function getRouteForUrl($url)
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
        $resourceId = array_shift($matches['id']);

        $nestedResources = [];
        foreach ($resourceElements as $key => $value) {
            $nestedResources[] = [
                'resource' => $value,
                'id' => isset($matches['id'][$key]) ? $matches['id'][$key] : null,
            ];
        }

        $route = new RestRoute($resourceName, $resourceId, $nestedResources);

        return $route;
    }
}
