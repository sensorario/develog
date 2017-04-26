<?php

namespace Sensorario\Develog\Logger;

class RawLogger extends AbstractLogger
{
    public function write(string $message)
    {
        $this->writeVeryRawLog($message);
    }
}
