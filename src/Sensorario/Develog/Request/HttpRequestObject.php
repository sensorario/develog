<?php

namespace Sensorario\Develog\Request;

class HttpRequestObject
{
    const REQUEST_METHOD = 'REQUEST_METHOD';
    const REQUEST_URI  = 'REQUEST_URI';
    const REMOTE_ADDR  = 'REMOTE_ADDR';
    const HTTP_USER_AGENT  = 'HTTP_USER_AGENT';
    const HTTP_ACCEPT  = 'HTTP_ACCEPT';

    private $params;

    private function __construct(array $params)
    {
        $this->params = $params;
    }

    public static function fromArray(array $params)
    {
        return new self($params);
    }

    /**
     * @codeCoverageIgnore
     */
    public static function handleRequest()
    {
        return new self([
            self::REQUEST_METHOD=> $_SERVER['REQUEST_METHOD'],
            self::REQUEST_URI => $_SERVER['REQUEST_URI'],
            self::REMOTE_ADDR => $_SERVER['REMOTE_ADDR'],
            self::HTTP_USER_AGENT => $_SERVER['HTTP_USER_AGENT'],
            self::HTTP_ACCEPT => $_SERVER['HTTP_ACCEPT'],
        ]);
    }

    public function getHttpVerb()
    {
        return $this->params[self::REQUEST_METHOD];
    }

    public function getRequestUri()
    {
        return $this->params[self::REQUEST_URI];
    }

    public function getRemoteAddress()
    {
        return $this->params[self::REMOTE_ADDR];
    }

    public function getUserAgent()
    {
        return $this->params[self::HTTP_USER_AGENT];
    }

    public function getAccept()
    {
        return $this->params[self::HTTP_ACCEPT];
    }
}
