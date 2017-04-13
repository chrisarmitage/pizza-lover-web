<?php

namespace Framework\Controller\Book;

use Framework\Repository\Book;

class Read
{
    public function dispatch($resourceId, $nestedResources = [])
    {
        $repository = new Book();

        return $repository->get($nestedResources['Resource'], $resourceId);
    }
}
