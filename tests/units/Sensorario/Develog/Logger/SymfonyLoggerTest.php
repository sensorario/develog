<?php

use PHPUnit\Framework\TestCase;
use Sensorario\Develog\Logger\SymfonyLogger;

class SymfonyLoggerTest extends TestCase
{
    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Oops! Any log file defined
     */
    public function test()
    {
        $this->symfonyRequest = $this
            ->getMockBuilder('Symfony\Component\HttpFoundation\Request')
            ->disableOriginalConstructor()
            ->getMock();
        $this->symfonyRequest->server = $this
            ->getMockBuilder('Symfony\Component\HttpFoundation\ServerBag')
            ->disableOriginalConstructor()
            ->setMethods(['get'])
            ->getMock();

        $logger = new SymfonyLogger();
        $logger->logSymfonyRequest($this->symfonyRequest);
    }
}
