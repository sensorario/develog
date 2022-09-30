<?php

use PHPUnit\Framework\TestCase;
use Sensorario\Develog\Logger;

class LoggerTest extends TestCase
{
    public function setUp(): void
    {
        $this->logFolderPath = __DIR__ . '/../../../';
        $this->logFileName = $this->logFolderPath . '/foo.log';

        @unlink($this->logFileName);

        $this->logger = new Logger();
    }

    public function testMustBeDefinedWithLogFile()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Oops! Any log file defined');

        $this->logger->log('INFO', 'message');
    }

    public function testLogFileAccessorsSetAndGetLogFile()
    {
        $this->logger->setLogFile($this->logFileName);

        $this->assertEquals(
            $this->logFileName,
            $this->logger->getLogFile()
        );
    }

    public function testCreatesFileAfterLogRequest()
    {
        $this->assertFalse(file_exists($this->logFileName));

        $this->logger->setLogFile($this->logFileName);
        $this->logger->logRequest(new MockRequest());

        $this->assertTrue(file_exists($this->logFileName));
    }

    public function testCreatesFileAfterLogResponse()
    {
        $this->assertFalse(file_exists($this->logFileName));

        $this->logger->setLogFile($this->logFileName);
        $this->logger->logResponse(new MockResponse());

        $this->assertTrue(file_exists($this->logFileName));
    }
}
