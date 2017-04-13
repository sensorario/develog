# Upgrade from 1.1

## `Sensorario\\Develog\\Logger\\NormaLogger`

    public function write(string $message) : void
    public function logClass($object, $message = 'object of class ') : void
    public function logClassWithMessage($object, $message) : void
    public function logType($object) : void
    public function logArray(array $var) : void
    public function logExport($content) : void