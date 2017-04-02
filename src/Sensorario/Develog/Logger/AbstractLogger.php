<?php

namespace Sensorario\Develog\Logger;

abstract class AbstractLogger
{
    protected $handler;

    protected $logFile;

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

    public function setLogFile($logFile) : void
    {
        $this->logFile = $logFile;
    }

    public function getLogFile() : string
    {
        return $this->logFile;
    }

    public function __destruct()
    {
        if ($this->handler) {
            fclose($this->getHandler());
        }
    }

    public function getTime() : string
    {
        $now = new \DateTime('now');
        $format = '[Y-m-d H:i:s]';

        return $now->format($format);
    }

    protected function writeLog($message, $level = 'INFO') : void
    {
        $level = strtoupper($level);
        $message = $this->getTime() . " log.$level $message\n";
        fwrite($this->getHandler(), $message);
    }
}