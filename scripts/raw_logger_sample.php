<?php

require __DIR__ . '/../vendor/autoload.php';

use Sensorario\Develog\Logger\RawLogger;

$logger = new RawLogger();
$logger->setLogFile(__DIR__ . '/../var/logs/foo.log');

$logger->write('foo bar');
