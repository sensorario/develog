<?php

namespace Sensorario\Develog;

use Sensorario\Develog\Request;

class Logger extends PsrLogger
{
    private $handler;

    private $logFile;

    public function getTime()
    {
        $now = new \DateTime('now');
        $format = '[Y-m-d H:i:s]';

        return $now->format($format);
    }

    public function __destruct()
    {
        if ($this->handler) {
            fclose($this->getHandler());
        }
    }

    public function getHandler()
    {
        if (!$this->handler) {
            if (!$this->logFile) {
                throw new \RuntimeException(
                    'Oops! Any log file defined'
                );
            }

            $this->handler = fopen($this->logFile, 'a+');
        }

        return $this->handler;
    }

    public function setLogFile($logFile)
    {
        $this->logFile = $logFile;
    }

    public function getLogFile() : string
    {
        return $this->logFile;
    }

    public function logRequest(Request $request)
    {
        $this->writeLog(
            "> " .  $request->getHttpVerb() .
            " " . $request->getRequestUri() .
            " HTTP/1.1"
        );

        $this->writeLog("> Host: " . $request::getRemoteAddress());
        $this->writeLog("> User-Agent: " . $request::getUserAgent());
        $this->writeLog("> Accept: " . $request::getAccept());
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

    protected function writeLog($message, $level = 'INFO')
    {
        $level = strtoupper($level);
        $message = $this->getTime() . " log.$level $message\n";
        fwrite($this->getHandler(), $message);
    }
}
