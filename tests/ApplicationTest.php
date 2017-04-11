<?php

use Framework\App;
use Symfony\Component\HttpFoundation\Request;

class ApplicationTest extends \PHPUnit\Framework\TestCase
{
    public function testLoads()
    {
        $request = Request::create(
            '/hello-world',
            'GET'
        );

        $app = new App();

        $response = $app->processRequest($request);

        self::assertContains('[Route: /hello-world]', $response->getContent());
        self::assertContains('[Controller: Framework\Controller\HelloWorld]', $response->getContent());
        self::assertContains('[Response: Index]', $response->getContent());
    }

    public function testMultiLevelUrl()
    {
        $request = Request::create(
            '/hello-world/Admin/REPORT',
            'GET'
        );

        $app = new App();

        $response = $app->processRequest($request);

        self::assertContains('[Route: /hello-world/Admin/REPORT]', $response->getContent());
        self::assertContains('[Controller: Framework\Controller\HelloWorld\Admin\Report]', $response->getContent());
        self::assertContains('[Response: Report]', $response->getContent());
    }
}
