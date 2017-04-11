<?php

class RpcRouterTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \Framework\Router\RestRouter
     */
    protected $router;

    public function setUp()
    {
        $this->router = new \Framework\Router\RestRouter();
    }

    public function testParsesRootResourceUrl()
    {
        $controllerName = $this->router->getRouteForUrl('/resource');

        self::assertEquals('Framework\\Controller\\Resource', $controllerName->getResourceName());
        self::assertEquals(null, $controllerName->getResourceId());
    }

    public function testParsesResourceWithIdUrl()
    {
        $controllerName = $this->router->getRouteForUrl('/resource/1');

        self::assertEquals('Framework\\Controller\\Resource', $controllerName->getResourceName());
        self::assertEquals('1', $controllerName->getResourceId());
    }

    public function testIgnoresCaseOnResource()
    {
        $controllerName = $this->router->getRouteForUrl('/RESOURCE');

        self::assertEquals('Framework\\Controller\\Resource', $controllerName->getResourceName());
        self::assertEquals(null, $controllerName->getResourceId());
    }

    public function testPreservesCaseOnResourceId()
    {
        $controllerName = $this->router->getRouteForUrl('/RESOURCE/ID');

        self::assertEquals('Framework\\Controller\\Resource', $controllerName->getResourceName());
        self::assertEquals('ID', $controllerName->getResourceId());
    }

    public function testProcessesResourceDashes()
    {
        $controllerName = $this->router->getRouteForUrl('/resource-name');

        self::assertEquals('Framework\\Controller\\ResourceName', $controllerName->getResourceName());
    }

    public function testPreservesResourceIdDashes()
    {
        $controllerName = $this->router->getRouteForUrl('/resource-id/dash-id');

        self::assertEquals('Framework\\Controller\\ResourceId', $controllerName->getResourceName());
        self::assertEquals('dash-id', $controllerName->getResourceId());
    }
}
