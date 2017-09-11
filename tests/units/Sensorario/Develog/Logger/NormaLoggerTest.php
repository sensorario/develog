<?php

use PHPUnit\Framework\TestCase;
use Sensorario\Develog\Logger\NormaLogger;

class NormaLoggerTest extends TestCase
{
    public function setUp()
    {
        $this->logFolderPath = __DIR__ . '/../../../../../var/logs/';
        $this->logFileName = $this->logFolderPath . '/foo.log';

        @unlink($this->logFileName);

        $this->normalogger = new NormaLogger();
        $this->normalogger->setLogPath($this->logFolderPath);

        $this->cleanLogFolder();
    }

    private function cleanLogFolder()
    {
        $logFiles = $this->normalogger->getLogFiles();
        foreach ($logFiles as $fileToBeDeleted) {
            @unlink($this->logFolderPath . $fileToBeDeleted);
        }
    }

    public function testKnownLogFileSize()
    {
        touch($this->logFileName);
        $this->normalogger->setLogFile($this->logFileName);
        $this->assertEquals(0, $this->normalogger->getFileSize());
    }

    public function testKeepFileSizeFromFileSystem()
    {
        touch($this->logFileName);
        $h = fopen($this->logFileName, 'w');
        for ($i = 0; $i < rand(11, 99); $i++) {
            fwrite($h, $this->logFileName);
        }
        fclose($h);

        $fileSize = filesize($this->logFileName);

        $this->normalogger->setLogFile($this->logFileName);
        $this->assertEquals($fileSize, $this->normalogger->getFileSize());
    }

    public function test()
    {
        $this->normalogger->setLogFile($this->logFileName);
        $this->assertFalse($this->normalogger->hasReachedThresholds());
    }

    public function testLimitCanBeConfigurableAtRuntime()
    {
        touch($this->logFileName);
        $h = fopen($this->logFileName, 'w');
        for ($i = 0; $i < rand(11, 99); $i++) {
            fwrite($h, $this->logFileName);
        }
        fclose($h);

        $this->normalogger->setLogFile($this->logFileName);

        $fileSize = filesize($this->logFileName);
        $this->normalogger->setSizeLimit($fileSize-1);
        $this->assertTrue($this->normalogger->hasReachedThresholds());
    }

    public function testCountHowManyLogExistsOnFileSystem()
    {
        $this->assertEquals(0, $this->normalogger->countLogFiles());

        $this->normalogger->setLogFile($this->logFileName);
        $this->normalogger->write('some content');

        $this->assertEquals(1, $this->normalogger->countLogFiles());

        $fileSize = filesize($this->logFileName);
        $this->normalogger->setSizeLimit($fileSize-1);

        $this->normalogger->write('foo');
        $this->assertEquals(2, $this->normalogger->countLogFiles());
    }

    public function testSetSizeLimitInBytes()
    {
        $this->normalogger->setSizeLimitInBytes(444);

        $this->assertEquals(
            444,
            $this->normalogger->getSizeLimitInBytes()
        );
    }

    public function testSetSizeLimnitInMb()
    {
        $this->normalogger->setSizeLimitInMB(2);

        $this->assertEquals(
            2048,
            $this->normalogger->getSizeLimitInBytes()
        );
    }

    public function tearDown()
    {
        $this->cleanLogFolder();
    }
}
