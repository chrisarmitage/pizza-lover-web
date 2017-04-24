<?php

namespace Framework\Controller\Book;

use Framework\Controller;
use Framework\Repository\Book;
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
        $repository = new Book();

        return $repository->get($this->route->getNestedResources()['Person'], $this->route->getResourceId());
    }
}
