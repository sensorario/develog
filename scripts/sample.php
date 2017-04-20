<?php

require __DIR__ . '/../vendor/autoload.php';

use Sensorario\Develog\Logger\NormaLogger;

$logger = new NormaLogger();
$logger->setLogFile(__DIR__ . '/../var/logs/foo.log');
$logger->setSizeLimit(222);

$logger->write('foo bar');
