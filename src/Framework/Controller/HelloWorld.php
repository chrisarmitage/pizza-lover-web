<?php

namespace Framework\Controller;

use Framework\Controller;

class HelloWorld implements Controller
{
    public function dispatch()
    {
        return 'Index';
    }
}
