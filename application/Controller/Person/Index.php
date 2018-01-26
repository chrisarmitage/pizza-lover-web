<?php

namespace Application\Controller\Person;

use Application\Repository\User;
use Framework\Controller;

class Index implements Controller
{
    public function dispatch()
    {
        $repository = new User();

        return $repository->getAll();
    }
}
