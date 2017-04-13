<?php

namespace Framework\Router;

use Framework\Route;

class RestRoute implements Route
{
    protected $controllerName;

    protected $resourceId;

    protected $nestedResources = [];

    /**
     * @param       $controllerName
     * @param       $resourceId
     * @param array $nestedResources
     */
    public function __construct($controllerName, $resourceId, array $nestedResources)
    {
        $this->controllerName = $controllerName;
        $this->resourceId = $resourceId;
        $this->nestedResources = $nestedResources;
    }

    /**
     * @return mixed
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }

    /**
     * @return mixed
     */
    public function getResourceId()
    {
        return $this->resourceId;
    }

    /**
     * @return array
     */
    public function getNestedResources()
    {
        return $this->nestedResources;
    }

}
