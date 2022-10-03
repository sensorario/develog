<?php

namespace Sensorario\Develog;

/** @codeCoverageIgnore */
abstract class PsrLogger implements
    \Psr\Log\LoggerInterface
{
    abstract protected function writeLog($message, $level = 'INFO');

    public function emergency($message, array $context = []): void
    {
        $this->writeLog($message, 'emergency');
    }

    public function alert($message, array $context = []): void
    {
        $this->writeLog($message, 'alert');
    }

    public function critical($message, array $context = []): void
    {
        $this->writeLog($message, 'critical');
    }

    public function error($message, array $context = []): void
    {
        $this->writeLog($message, 'error');
    }

    public function warning($message, array $context = []): void
    {
        $this->writeLog($message, 'warning');
    }

    public function notice($message, array $context = []): void
    {
        $this->writeLog($message, 'notice');
    }

    public function info($message, array $context = []): void
    {
        $this->writeLog($message, 'info');
    }

    public function debug($message, array $context = []): void
    {
        $this->writeLog($message, 'debug');
    }

    public function log($level, $message, array $context = []): void
    {
        $this->writeLog($message, 'log');
    }
}
