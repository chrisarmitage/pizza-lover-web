<?php

namespace Framework\Controller\Resource;

use Framework\Repository\User;

class Read
{
    public function dispatch($resourceId, $nestedResources = [])
    {
        $repository = new User();

        return $repository->get($resourceId);
    }
}
