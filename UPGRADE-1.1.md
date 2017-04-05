# Upgrade from 1.0

## Code coverage

Version `1.1` was not covered with tests. Version 1.1 fix this issue.

## `Sensorario\Develog\SymfonyLoggerInterface`

Introduced new interface to talk with Symfony requests and responses.

 - logSymfonyRequest
 - logSymfonyResponse
 - logRequestObject

## `Refresh command`

`./refresh` command now checkout master branch, pull latest master branch and remove all merged branches.

## `Sensorario\Develog\Logger\*` classes

New specific logger have been introduced.

 - `Sensorario\Develog\Logger\HttpLogger`
 - `Sensorario\Develog\Logger\SymfonyLogger`

## `Sensorario\Develog\Request\HttpRequestObject`

Is a wrapper of `$_SERVER` var.
