<?php

namespace Framework;

class ControllerResolver
{
    /**
     * @param string $controllerName
     * @return Controller
     * @throws \Exception
     */
    public function resolve($controllerName)
    {
        if (!method_exists($controllerName, 'dispatch')) {
            throw new \Exception("Could not find controller: {$controllerName}");
        }

        return new $controllerName;
    }
}
