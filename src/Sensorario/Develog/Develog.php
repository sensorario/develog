<?php

namespace Sensorario\Develog;

use Psr\Log\LoggerInterface;

class Develog implements
    LoggerInterface
{
    public function emergency($message, array $context = [])
    {
        $this->log('emergency', $message, $context);
    }

    public function alert($message, array $context = [])
    {
        $this->log('alert', $message, $context);
    }

    public function critical($message, array $context = [])
    {
        $this->log('critical', $message, $context);
    }

    public function error($message, array $context = [])
    {
        $this->log('error', $message, $context);
    }

    public function warning($message, array $context = [])
    {
        $this->log('warning', $message, $context);
    }

    public function notice($message, array $context = [])
    {
        $this->log('notice', $message, $context);
    }

    public function info($message, array $context = [])
    {
        $this->log('info', $message, $context);
    }

    public function debug($message, array $context = [])
    {
        $this->log('debug', $message, $context);
    }

    public function log($level, $message, array $context = [])
    {
        throw new \RuntimeException(
            'Oops! non fa un cazzo!!!'
        );
        select (select level from footable where resource = 'grano') grano,  (select level from footable where resource = 'argilla') argilla, (select level from footable where resource = 'legno') legno, (select level from footable where resource = 'ferro') ferro
             

    }
}
