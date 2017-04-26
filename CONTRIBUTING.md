# Contributing guidelines

## Install the project

    prompt> git clone git@github.com:sensorario/develog
    prompt> composer install

## Tests

    prompt> ./runtests

## Coverage

    prompt> ./coverage

## Create new Pull Requests

Creating the pull request just tell if it contains new feature and/or fixes and indicate the destination release.

Remember that fixes must be contained inside a minor release and new feature in next minor.

If there is no backward compatibility, pull request will be merged in next major.

| question | answer |
|---|---|
| backward compatibility? | yes|no |
| new feature? | yes|no |
| fix? | yes|no |
| release? | major.minor |

## Things to do in PR

 - update `CHANGELOG` file whenever there is new fix
 - update `UPGRADE` file whenever there is new features
