# Usages

## Log into file

```
use Sensorario\Develog\Logger\NormaLogger;

$logger = new NormaLogger();
$logger->setLogFile('/path/to/file');
$logger->write('log this content …');
$logger->logClass($object);

$obj = new \Bar\Foo();
$logger->logClassWithMessage($obj, 'log this'); // log this \Bar\Foo()
```

## Handle Http Request

```
use Sensorario\Develog\Logger\HttpLogger;
use Sensorario\Develog\Request\HttpRequestObject;

$logger = new HttpLogger();
$logger->setLogFile($this->getParameter('kernel.root_dir').'/../var/logs/foo.log');
$logger->logRequest(HttpRequestObject::handleRequest());
```

## Handle Symfony Request

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
