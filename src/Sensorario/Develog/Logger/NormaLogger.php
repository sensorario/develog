<?php

namespace Sensorario\Develog\Logger;

final class NormaLogger extends AbstractLogger
{
    public function write(string $message) : void
    {
        $this->writeLog($message);
    }

    public function logClass($object, $message = 'object of class ') : void
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

    /** @todo add logIfObject */
    /** @todo add varExport */
    /** @todo add logType */
}
