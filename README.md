# Develog

These are a family of Logger I use in development. Sometimes to log in a particular file. Sometimes to format json responses. Is an indipendent library and do not need vendor except for Psr\Log\LoggerInterface.

## Usages

 - [log into file](#log-into-file)
 - [handle http request](#handle-http-request)
 - [handle Symfony request](#handle-symfony-request)
 - [create symfony service](#create-symfony-service)
 - [configure log size](#configure-log-size)

## Tree

Here the tree starting from version 1.3.0

```
src/
└── Sensorario
    └── Develog
        ├── Logger
        │   ├── AbstractLogger.php
        │   ├── HttpLogger.php
        │   ├── LoggerInterface.php
        │   ├── NoDateLogger.php
        │   ├── NormaLogger.php
        │   ├── RawLogger.php
        │   └── SymfonyLogger.php
        ├── Logger.php
        ├── PsrLogger.php
        ├── Request
        │   ├── HttpRequestObject.php
        │   └── RequestInterface.php
        ├── Request.php
        ├── Response.php
        └── SymfonyLoggerInterface.php
```

### Just log without date and level

```
use Sensorario\Develog\Logger\RawLogger;

$logger = new RawLogger();
$logger->setLogFile('/path/to/file');
$logger->write('log this content …');
```

### Configure log size

```
use Sensorario\Develog\Logger\RawLogger;

$logger = new RawLogger();
$logger->setLogFile('/path/to/file');
$logger->setSizeLimit(2000000);
```

### Log without date

```
use Sensorario\Develog\Logger\NoDateLogger;

$logger = new NoDateLogger();
$logger->setLogFile('/path/to/file');
$logger->write('log this content …');
```

### Log into file

```
use Sensorario\Develog\Logger\NormaLogger;

$logger = new NormaLogger();
$logger->setLogFile('/path/to/file');
$logger->write('log this content …');
$logger->logClass($object);

$obj = new \Bar\Foo();
$logger->logClassWithMessage($obj, 'log this'); // log this \Bar\Foo()
```

### Handle Http Request

```
use Sensorario\Develog\Logger\HttpLogger;
use Sensorario\Develog\Request\HttpRequestObject;

$logger = new HttpLogger();
$logger->setLogFile($this->getParameter('kernel.root_dir').'/../var/logs/foo.log');
$logger->logRequest(HttpRequestObject::handleRequest());
```

### Handle Symfony Request

```
use Sensorario\Develog\Logger\SymfonyLogger;
use Sensorario\Develog\Request\HttpRequestObject;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

public function indexAction(Request $request)
{
    $logger = new SymfonyLogger();
    $logger->setLogFile($this->getParameter('kernel.root_dir').'/../var/logs/foo.log');
    $logger->logSymfonyRequest($request);

    $response = new Response('foo');
    $logger->logSymfonyRequest($response);
}
```

### Create Symfony service

This is not mandatory, but if you want you can also configure these services inside your services.yml file when using a Symfony application. Because of I always use develo just for development purpose I have never added it as service: I still prefer copy and paste the needed code from this file. Maybe in the future I'll create a Bundle that provide some services by itself.

```
services:

  logger.normal:
    class: Sensorario\Develog\Logger\NormaLogger

  logger.symfony
    class: Sensorario\Develog\Logger\SymfonyLogger

  logger.http
    class: Sensorario\Develog\Logger\HttpLogger
```
