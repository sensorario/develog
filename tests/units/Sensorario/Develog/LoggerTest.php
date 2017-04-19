<?php

use PHPUnit\Framework\TestCase;
use Sensorario\Develog\Logger;

class LoggerTest extends TestCase
{
    public function setUp()
    {
        $this->logFolderPath = __DIR__ . '/../../../';
        $this->logFileName = $this->logFolderPath . '/foo.log';

        @unlink($this->logFileName);

        $this->logger = new Logger();
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Oops! Any log file defined
     */
    public function testMustBeDefinedWithLogFile()
    {
        $this->logger->log('INFO', 'message');
    }

    /**
     * @covers Sensorario\Develog\Logger\AbstractLogger::getLogFile
     */
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

    public function tearDown()
    {
        //@unlink($this->logFileName);
    }

    public function test()
    {
        $returnMessage = 'one line content';

        $this->symfonyRequest = $this
            ->getMockBuilder('Symfony\Component\HttpFoundation\Request')
            ->disableOriginalConstructor()
            ->setMethods(['getContent'])
            ->getMock();
        $this->symfonyRequest->server = $this
            ->getMockBuilder('Symfony\Component\HttpFoundation\ServerBag')
            ->disableOriginalConstructor()
            ->setMethods(['get'])
            ->getMock();
        $this->symfonyRequest->server->expects($this->at(0))
            ->method('get')
            ->with('REQUEST_METHOD')
            ->will($this->returnValue('GET'));
        $this->symfonyRequest->server->expects($this->at(1))
            ->method('get')
            ->with('REQUEST_URI')
            ->will($this->returnValue($returnMessage));

        $this->assertFalse(file_exists($this->logFileName));

        $this->logger->setLogFile($this->logFileName);
        $this->logger->logSymfonyRequest($this->symfonyRequest);

        $this->assertTrue(file_exists($this->logFileName));
        $this->assertRegexp(
            '/' . $returnMessage . '/',
            file_get_contents($this->logFileName)
        );
    }
}

class MockRequest implements
    \Sensorario\Develog\Request
{
    public function getHttpVerb()
    {
    }

    public static function getRequestUri()
    {
    }

    public static function getRemoteAddress()
    {
    }

    public static function getUserAgent()
    {
    }

    public static function getAccept()
    {
    }
}

class MockResponse implements
    \Sensorario\Develog\Response
{
    public function getContent()
    {
    }
}
