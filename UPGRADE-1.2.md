# Upgrade from 1.1

## `Sensorario\\Develog\\Logger\\AbstractLogger`

    public function ensureFileItsBeenCreated() : void
    public function ensureFileRotation() : void
    public function ensureLogFileIsDefined() : void
    public function getFileSize() : int
    public function getSizeLimit() : int
    public function setSizeLimit() : void

## `Sensorario\\Develog\\Logger\\NormaLogger`

    public function countLogFiles() : int
    public function getLogFiles() : array
    public function hasReachedThresholds() : bool
    public function isLogFileDefined() : bool
    public function logArray(array $var) : void
    public function logClass($object, $message = 'object of class ') : void
    public function logClassWithMessage($object, $message) : void
    public function logExport($content) : void
    public function logType($object) : void
    public function setLogPath(string $path) : Logger
    public function write(string $message) : void

## `Sensorario\\Develog\\Logger\\NoDateLogger`

    public function write(string $message) : void
