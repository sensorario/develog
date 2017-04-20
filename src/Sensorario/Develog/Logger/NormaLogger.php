<?php

namespace Sensorario\Develog\Logger;

class NormaLogger extends AbstractLogger
{
    private $logFileName;

    private $logFolderPath;

    public function write(string $message)
    {
        $this->writeLog($message);
    }

    public function logClass($object, $message = 'object of class ')
    {
        $this->logClassWithMessage($object, 'object of class');
    }

    public function logClassWithMessage($object, $message)
    {
        if (!is_object($object)) {
            throw new \RuntimeException(
                'Oops! Trying to log a non object as object'
            );
        }

        $this->writeLog($message . ' ' . get_class($object));
    }

    public function logType($object)
    {
        $this->writeLog(gettype($object));
    }

    public function logArray(array $var)
    {
        $this->logExport($var);
    }

    public function logExport($content)
    {
        $this->writeLog(var_export($content, true));
    }

    public function hasReachedThresholds()
    {
        return $this->getFileSize() > $this->getSizeLimit();
    }

    public function setLogPath($path)
    {
        $this->logFolderPath = $path;

        return $this;
    }

    private function isLogFileDefined()
    {
        try {
            $this->getLogFile();
        } catch(\RuntimeException $exception) {
            return false;
        }

        return true;
    }

    public function getLogFiles()
    {
        $filesinffolder = $this->scanPath($this->logFolderPath);
        $fileNames = [];
        foreach ($filesinffolder as $filename) {
            if (substr($filename, -4) === '.log') {
                $fileNames[] = $filename;
            }
        }

        return $fileNames;
    }

    private function scanPath($path)
    {
        return scandir($path);
    }

    public function countLogFiles()
    {
        if (!$this->islogfiledefined()) {
            return 0;
        }

        $logpath = realpath(substr(
            $this->getlogfile(),
            0,
            strrpos($this->getlogfile(), '/')
        ));

        $filesinffolder = $this->scanPath($logpath);
        $numberoflogsfound = 0;
        foreach ($filesinffolder as $filename) {
            if (substr($filename, -4) === '.log') {
                $numberoflogsfound++;
            }
        }

        return $numberoflogsfound;
    }

    /** @todo add logIfObject */
}
