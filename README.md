# Usages

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
use Symfony\Component\HttpFoundation\Request;
use Sensorario\Develog\Logger\SymfonyLogger;
use Sensorario\Develog\Request\HttpRequestObject;

public function indexAction(Request $request)
{
    $logger = new SymfonyLogger();
    $logger->setLogFile($this->getParameter('kernel.root_dir').'/../var/logs/foo.log');
    $logger->logSymfonyRequest($request);
}
```
