<?php

declare(strict_types=1);

namespace Framework\Controller\Person;

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
