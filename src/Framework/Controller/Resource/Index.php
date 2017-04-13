<?php

namespace Framework\Controller\Resource;

use Framework\Controller;
use Framework\Repository\User;
use Framework\Router\RestRoute;

class Index implements Controller
{
    public function dispatch(RestRoute $route)
    {
        $repository = new User();

        return $repository->getAll();
    }
}
