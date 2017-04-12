<?php

namespace Framework\Router;

use Framework\Route;

class RpcRoute implements Route
{
    protected $controllerName;

    /**
     * @param $controllerName
     */
    public function __construct($controllerName)
    {
        $this->controllerName = $controllerName;
    }

    /**
     * @return mixed
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }

}
