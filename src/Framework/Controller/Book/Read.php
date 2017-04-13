<?php

namespace Framework\Controller\Book;

use Framework\Controller;
use Framework\Repository\Book;
use Framework\Router\RestRoute;

class Read implements Controller
{
    public function dispatch(RestRoute $route)
    {
        $repository = new Book();

        return $repository->get($route->getNestedResources()['Resource'], $route->getResourceId());
    }
}
