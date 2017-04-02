<?php

namespace Sensorario\Develog\Request;

interface RequestInterface
{
    public static function handleRequest();

    public function getHttpVerb();

    public function getRequestUri();

    public function getRemoteAddress();

    public function getUserAgent();

    public function getAccept();
}
