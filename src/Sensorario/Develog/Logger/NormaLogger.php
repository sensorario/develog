<?php

namespace Sensorario\Develog\Logger;

class NormaLogger extends AbstractLogger
{
    public function write(string $message) : void
    {
        $this->writeLog($message);
    }

    public function logClass($object, $message = 'object of class ') : void
    {
        $this->logClassWithMessage($object, 'object of class');
    }

    public function logClassWithMessage($object, $message) : void
    {
        if (!is_object($object)) {
            throw new \RuntimeException(
                'Oops! Trying to log a non object as object'
            );
        }

        $this->writeLog($message . ' ' . get_class($object));
    }

    public function logType($object) : void
    {
        $this->writeLog(gettype($object));
    }

    public function logArray(array $var) : void
    {
        $this->logExport($var);
    }

    public function logExport($content)
    {
        $this->writeLog(var_export($var, true));
    }

    /** @todo add logIfObject */
}
