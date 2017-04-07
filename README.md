# Usages

## Log into file

```
use Sensorario\Develog\Logger\NormalLogger;

$logger = new NormalLogger();
$logger->setLogFile('/path/to/file');
$logger->log('log this content …');
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
