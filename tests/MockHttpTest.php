<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class MockHttpTest extends TestCase
{
    public function testMockRequest()
    {
        $mock = new MockHandler([
            new Response(200, [], 'OK')
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $response = $client->get('/test');

        $this->assertEquals(200, $response->getStatusCode());
    }
}
