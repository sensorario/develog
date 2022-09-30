<?php

use PHPUnit\Framework\TestCase;
use Sensorario\Develog\Logger\HttpLogger;

class HttpLoggerTest extends TestCase
{
    public function setUp(): void
    {
        $this->logFileName = __DIR__ . '/../../../../../var/logs/delete.log';
    }

    public function testThrowExceptionWhenInvokedWithUndefinedLogFile()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Oops! Any log file defined');

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

        $logger->logRequest($this->httpRequestObject);

        $this->assertFileExists($this->logFileName);
    }

    public function tearDown(): void
    {
        @unlink($this->logFileName);
    }
}
