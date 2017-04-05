<?php

use PHPUnit\Framework\TestCase;
use Sensorario\Develog\Request\HttpRequestObject;

class HttpRequestObjectTest extends TestCase
{
    public function setUp()
    {
        $params = [
            HttpRequestObject::REQUEST_METHOD => 'GET',
            HttpRequestObject::REQUEST_URI => '/foo',
            HttpRequestObject::HTTP_USER_AGENT => 'User-Agent',
            HttpRequestObject::HTTP_ACCEPT => '*',
            HttpRequestObject::REMOTE_ADDR => 'http://foo',
        ];

        $this->request = HttpRequestObject::fromArray($params);
    }

    public function testProvideRequestMethod()
    {
        $this->assertEquals('GET', $this->request->getHttpVerb());
    }

    public function testMapRequestUri()
    {
        $this->assertEquals('/foo', $this->request->getRequestUri());
    }

    public function testKnowsUserAgent()
    {
        $this->assertEquals('User-Agent', $this->request->getUserAgent());
    }

    public function testAccept()
    {
        $this->assertEquals('*', $this->request->getAccept());
    }

    public function testRemoteAddr()
    {
        $this->assertEquals('http://foo', $this->request->getRemoteAddress());
    }
}
