<?php

namespace Framework;

use Framework\Router\RestRoute;

interface Controller
{
    /**
     * @param RestRoute $route
     * @return mixed
     */
    public function dispatch(RestRoute $route);
}
