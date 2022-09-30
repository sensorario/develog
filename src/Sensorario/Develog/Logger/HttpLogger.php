<?php

namespace Sensorario\Develog\Logger;

use Sensorario\Develog\Request\HttpRequestObject;
use Sensorario\Develog\Response;

final class HttpLogger extends AbstractLogger
{
    public function logRequest(HttpRequestObject $request)
    {
        $this->writeLog(
            "> " .  $request->getHttpVerb() .
            " " . $request->getRequestUri() .
            " HTTP/1.1"
        );

        $this->writeLog("> Host: " . $request->getRemoteAddress());
        $this->writeLog("> User-Agent: " . $request->getUserAgent());
        $this->writeLog("> Accept: " . $request->getAccept());
        $this->writeLog("> ");
    }

    public function logResponse(Response $response)
    {
        $this->writeLog("< HTTP/1.1 200 OK");
        $this->writeLog("< Date: " . (new \DateTime('now'))->format('D, d M Y H:i:s'));
        $this->writeLog("< Content-Type: applicarion/json");
        $this->writeLog("<");
        $lines = explode("\n", $response->getContent());

        foreach ($lines as $line) {
            $this->writeLog($line);
        }

        $this->writeLog("");
    }
}
