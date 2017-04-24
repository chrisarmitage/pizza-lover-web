<?php

namespace Framework\Controller\Person;

use Framework\Controller;
use Framework\Repository\User;
use Framework\Router\RestRoute;

class Read implements Controller
{
    /**
     * @var RestRoute
     */
    protected $route;

    /**
     * @param RestRoute $route
     */
    public function __construct(RestRoute $route)
    {
        $this->route = $route;
    }

    public function dispatch()
    {
        $repository = new User();

        return $repository->get($this->route->getResourceId());
    }
}
