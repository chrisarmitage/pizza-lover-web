<?php

declare(strict_types=1);

namespace Framework;

interface Controller
{
    /**
     * @return mixed
     */
    public function dispatch();
}
