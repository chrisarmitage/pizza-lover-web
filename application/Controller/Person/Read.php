<?php

namespace Application\Controller\Person;

use Application\Repository\User;
use Framework\Controller;
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
