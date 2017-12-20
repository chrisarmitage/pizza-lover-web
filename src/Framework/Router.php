<?php

declare(strict_types=1);

namespace Framework;

use Framework\Router\RestRoute;
use Framework\Router\RpcRoute;

interface Router
{
    /**
     * @param string $url
     * @return RpcRoute|RestRoute
     */
    public function getRouteForUrl($url);
}
