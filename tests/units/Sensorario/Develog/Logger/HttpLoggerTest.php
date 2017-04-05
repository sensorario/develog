<?php

use PHPUnit\Framework\TestCase;
use Sensorario\Develog\Logger\HttpLogger;

class HttpLoggerTest extends TestCase
{
    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Oops! Any log file defined
     */
    public function testThrowExceptionWhenInvokedWithUndefinedLogFile()
    {
        $this->httpRequestObject = $this
            ->getMockBuilder('Sensorario\Develog\Request\HttpRequestObject')
            ->disableOriginalConstructor()
            ->getMock();

        $logger = new HttpLogger();
        $logger->logRequest($this->httpRequestObject);
    }

    public function testCreatesFileIfNotExists()
    {
        $this->httpRequestObject = $this
            ->getMockBuilder('Sensorario\Develog\Request\HttpRequestObject')
            ->disableOriginalConstructor()
            ->getMock();

        $logFileName = __DIR__ . '/../../../../../var/delete.log';

        $logger = new HttpLogger();
        $logger->setLogFile($logFileName);

        @unlink($logFileName);
        $this->assertFileNotExists($logFileName);

        $logger->logRequest($this->httpRequestObject);

        $this->assertFileExists($logFileName);
    }
}
