<?php

namespace Sensorario\Develog;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface SymfonyLoggerInterface
{
    public function logSymfonyRequest(Request $request);

    public function logSymfonyResponse(Response $response);
}
