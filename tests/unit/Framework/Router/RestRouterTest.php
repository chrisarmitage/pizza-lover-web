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

    public function testParsesNestedRootResourceUrl()
    {
        $controllerName = $this->router->getRouteForUrl('/resource/1/sub-resource');

        self::assertEquals('Framework\\Controller\\Resource', $controllerName->getResourceName());
        self::assertEquals('1', $controllerName->getResourceId());
        self::assertCount(1, $controllerName->getNestedResources());
        self::assertEquals(
            [
                'resource' => 'SubResource',
                'id' => null,
            ],
            $controllerName->getNestedResources()[0]
        );
    }

    public function testParsesNestedResourceUrl()
    {
        $controllerName = $this->router->getRouteForUrl('/resource/1/sub-resource/2');

        self::assertEquals('Framework\\Controller\\Resource', $controllerName->getResourceName());
        self::assertEquals('1', $controllerName->getResourceId());
        self::assertCount(1, $controllerName->getNestedResources());
        self::assertEquals(
            [
                'resource' => 'SubResource',
                'id' => '2',
            ],
            $controllerName->getNestedResources()[0]
        );
    }

    public function testParsesMultiNestedRootResourceUrl()
    {
        $controllerName = $this->router->getRouteForUrl('/resource/1/sub-resource/2/sub-sub-resource');

        self::assertEquals('Framework\\Controller\\Resource', $controllerName->getResourceName());
        self::assertEquals('1', $controllerName->getResourceId());
        self::assertCount(2, $controllerName->getNestedResources());
        self::assertEquals(
            [
                'resource' => 'SubResource',
                'id' => '2',
            ],
            $controllerName->getNestedResources()[0]
        );
        self::assertEquals(
            [
                'resource' => 'SubSubResource',
                'id' => null,
            ],
            $controllerName->getNestedResources()[1]
        );
    }

    public function testParsesMultiNestedResourceUrl()
    {
        $controllerName = $this->router->getRouteForUrl('/resource/1/sub-resource/2/sub-sub-resource/3');

        self::assertEquals('Framework\\Controller\\Resource', $controllerName->getResourceName());
        self::assertEquals('1', $controllerName->getResourceId());
        self::assertCount(2, $controllerName->getNestedResources());
        self::assertEquals(
            [
                'resource' => 'SubResource',
                'id' => '2',
            ],
            $controllerName->getNestedResources()[0]
        );
        self::assertEquals(
            [
                'resource' => 'SubSubResource',
                'id' => '3',
            ],
            $controllerName->getNestedResources()[1]
        );
    }
}
