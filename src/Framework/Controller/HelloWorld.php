<?php

declare(strict_types=1);

namespace Framework\Controller;

use Framework\Controller;

class HelloWorld implements Controller
{
    public function dispatch()
    {
        return 'Index';
    }
}
