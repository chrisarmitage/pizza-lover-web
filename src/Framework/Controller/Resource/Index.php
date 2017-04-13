<?php

namespace Framework\Controller\Resource;

use Framework\Repository\User;

class Index
{
    public function dispatch()
    {
        $repository = new User();

        return $repository->getAll();
    }
}
