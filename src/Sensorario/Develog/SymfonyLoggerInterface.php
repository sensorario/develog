<?php

namespace Sensorario\Develog;

use Symfony\Component\HttpFoundation\Request as SymfonyRequest;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

interface SymfonyLoggerInterface
{
    public function logSymfonyRequest(SymfonyRequest $request);

    public function logSymfonyResponse(SymfonyResponse $response);
}
