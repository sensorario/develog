# Upgrade from 1.x

## Removed classes

 - `Sensorario\Develog\Logger`
 - `Sensorario\Develog\PsrLogger`
 - `Sensorario\Develog\Request`
 - `Sensorario\Develog\Response`
 - `Sensorario\Develog\SymfonyLoggerInterface`

## New classes

 - `Sensorario\Develog\Logger\HttpLogger`
 - `Sensorario\Develog\Logger\SymfonyLogger`
 - `Sensorario\Develog\Logger\LoggerInterface`
 - `Sensorario\Develog\Logger\AbstractLogger`
 - `Sensorario\Develog\Logger\NormaLogger`

## New Objects

 - `Sensorario\Develog\Request\HttpRequestObject`
 - `Sensorario\Develog\Request\RequestInterface`
