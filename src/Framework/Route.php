<?php

declare(strict_types=1);

namespace Framework;

interface Route
{
    /**
     * @return string
     */
    public function getControllerName();
}
