<?php

namespace Sensorario\Develog\Logger;

use Symfony\Component\HttpFoundation\Request as SymfonyRequest;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

final class SymfonyLogger extends AbstractLogger
{
    public function logSymfonyRequest(SymfonyRequest $request) : void
    {
        $this->writeLog(
            '> ' . $request->server->get('REQUEST_METHOD') .
            ' ' . $request->server->get('REQUEST_URI')
        );
    }

    public function logSymfonyResponse(SymfonyResponse $response) : void
    {
        $this->writeLog("< " . $response->getContent());
    }
}
