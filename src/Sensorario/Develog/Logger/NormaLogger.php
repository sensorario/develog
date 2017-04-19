<?php

namespace Sensorario\Develog\Logger;

class NormaLogger extends AbstractLogger
{
    public function write(string $message)
    {
        $this->writeLog($message);
    }

    public function logClass($object, $message = 'object of class ')
    {
        $this->logClassWithMessage($object, 'object of class');
    }

    public function logClassWithMessage($object, $message)
    {
        if (!is_object($object)) {
            throw new \RuntimeException(
                'Oops! Trying to log a non object as object'
            );
        }

        $this->writeLog($message . ' ' . get_class($object));
    }

    public function logType($object)
    {
        $this->writeLog(gettype($object));
    }

    public function logArray(array $var)
    {
        $this->logExport($var);
    }

    public function logExport($content)
    {
        $this->writeLog(var_export($content, true));
    }

    /** @todo add logIfObject */
}
