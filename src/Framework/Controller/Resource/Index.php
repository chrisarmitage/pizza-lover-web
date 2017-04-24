<?php

namespace Framework\Controller\Resource;

use Framework\Controller;
use Framework\Repository\User;

class Index implements Controller
{
    public function dispatch()
    {
        $repository = new User();

        return $repository->getAll();
    }
}
