<?php

namespace Framework\Router;

class RestRoute
{
    protected $resourceName;

    protected $resourceId;

    protected $nestedResources = [];

    /**
     * @param       $resourceName
     * @param       $resourceId
     * @param array $nestedResources
     */
    public function __construct($resourceName, $resourceId, array $nestedResources)
    {
        $this->resourceName = $resourceName;
        $this->resourceId = $resourceId;
        $this->nestedResources = $nestedResources;
    }

    /**
     * @return mixed
     */
    public function getResourceName()
    {
        return $this->resourceName;
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
