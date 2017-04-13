<?php

namespace Framework\Controller\Book;

use Framework\Controller;
use Framework\Repository\Book;
use Framework\Router\RestRoute;

class Index implements Controller
{
    public function dispatch(RestRoute $route)
    {
        $repository = new Book();

        return $repository->getAll($route->getNestedResources()['Resource']);
    }
}
