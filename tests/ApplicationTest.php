<?php

use Framework\App;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApplicationTest extends \PHPUnit\Framework\TestCase
{
    public function testReturnsResponse()
    {
        $request = Request::create(
            '/resource',
            'GET'
        );

        $app = new App(new \Framework\Router\RestRouter());

        $response = $app->processRequest($request);

        self::assertInstanceOf(Response::class, $response);
        //self::assertContains('[Route: /hello-world]', $response->getContent());
        //self::assertContains('[Controller: Framework\Controller\HelloWorld]', $response->getContent());
        //self::assertContains('[Response: Index]', $response->getContent());
    }

}
