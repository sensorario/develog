<?php

use PHPUnit\Framework\TestCase;
use Sensorario\Develog\Logger\HttpLogger;

class HttpLoggerTest extends TestCase
{
    public function setUp()
    {
        $this->logFileName = __DIR__ . '/../../../../../var/delete.log';
    }

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

        $logger = new HttpLogger();
        $logger->setLogFile($this->logFileName);

        @unlink($this->logFileName);
        $this->assertFileNotExists($this->logFileName);

        $logger->logRequest($this->httpRequestObject);

        $this->assertFileExists($this->logFileName);
    }

    public function tearDown()
    {
        @unlink($this->logFileName);
    }
}
