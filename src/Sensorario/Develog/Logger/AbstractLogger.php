<?php

namespace Sensorario\Develog\Logger;

use Psr\Log\AbstractLogger as PsrAbstractLogger;

abstract class AbstractLogger extends PsrAbstractLogger
{
    protected $handler;

    protected $logFile;

    protected $sizeLimit;

    public function getHandler()
    {
        if (!$this->handler) {
            $this->ensureLogFileIsDefined();
            $this->handler = fopen($this->logFile, 'a+');
        }

        return $this->handler;
    }

    public function setLogFile($logFile)
    {
        $this->ensureFileItsBeenCreated($logFile);
    }

    /**
     * @codeCoverageIgnore
     */
    public function getLogFile() : string
    {
        $this->ensureLogFileIsDefined();

        return $this->logFile;
    }

    public function __destruct()
    {
        if ($this->handler) {
            fclose($this->getHandler());
        }
    }

    public function getTime() : string
    {
        $now = new \DateTime('now');
        $format = '[Y-m-d H:i:s]';

        return $now->format($format);
    }

    public function log($level, $message, array $context = array())
    {
        $this->writeLog($message, $level);
    }

    protected function writeLog($message, $level = 'INFO')
    {
        $level = strtoupper($level);
        $message = $this->getTime() . " log.$level $message\n";
        $this->writeToFile($message);
    }

    protected function writeRawLog($message, $level = 'INFO')
    {
        $level = strtoupper($level);
        $message = " log.$level $message\n";
        $this->writeToFile($message);
    }

    private function writeToFile($message)
    {
        fwrite($this->getHandler(), $message);

        if (filesize($logFile = $this->getLogFile()) >= $this->getSizeLimit()) {
            $this->ensureFileRotation($logFile);
        }
    }

    public function getFileSize()
    {
        return filesize($this->getLogFile());
    }

    protected function getSizeLimit()
    {
        return null === $this->sizeLimit
            ? 2000
            : $this->sizeLimit;
    }

    public function setSizeLimit($limit)
    {
        $this->sizeLimit = $limit;
    }

    public function ensureFileRotation($filename)
    {
        /** @todo cover this case */
        if (!file_exists($filename)) {
            throw new \RuntimeException(
                'Oops! Log file not exists'
            );
        }

        $newCandidate = substr(realpath($filename), 0, strlen(realpath($filename)) - 4);

        /** @todo cover file name generated */
        for ($i = 1;; $i++) {
            $logNameBlaBla = "$newCandidate.$i.log";
            if (!file_exists($logNameBlaBla)) {
                rename($filename, $logNameBlaBla);
                $this->ensureFileItsBeenCreated($filename);
                return true;
            }
        }

        return true;
    }

    /** @todo cover this case */
    private function ensureFileItsBeenCreated($filename)
    {
        if (!touch($this->logFile = $filename)) {
            throw new \RuntimeException(
                'Oops! File cannot be created'
            );
        }
    }

    private function ensureLogFileIsDefined()
    {
        if (!$this->logFile) {
            throw new \RuntimeException(
                'Oops! Any log file defined'
            );
        }
    }
}
