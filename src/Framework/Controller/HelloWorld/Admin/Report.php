<?php

declare(strict_types=1);

namespace Framework\Controller\HelloWorld\Admin;

use Framework\Controller;

class Report implements Controller
{
    public function dispatch()
    {
        return 'Report';
    }
}
