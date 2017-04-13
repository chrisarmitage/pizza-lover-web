<?php

namespace Framework\Controller\Book;

use Framework\Repository\Book;

class Index
{
    public function dispatch($resourceId, $nestedResources)
    {
        $repository = new Book();

        return $repository->getAll($nestedResources['Resource']);
    }
}
