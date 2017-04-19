<?php

namespace Sensorario\Develog\Logger;

class NoDateLogger extends AbstractLogger
{
    public function write(string $message)
    {
        $this->writeRawLog($message);
    }
}
