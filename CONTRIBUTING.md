# Contributing guidelines

## Install the project

    prompt> git clone git@github.com:sensorario/develog
    prompt> composer install

## Tests

    prompt> ./runtests

## Coverage

    prompt> ./coverage

## Create new Pull Requests

Each pull request must contains a table to describe its purpose following semver logc: indicates if this pr contains BC, new features or fxes. Finally, must indicate the destination release.

```
| question | answer |
|---|---|
| backward compatibility? | yes |
| new feature? | no |
| bug fix? | no |
| new deprecations? | no |
| refactoring? | no |

PR Description

 - [ ] stuff to do
 - [ ] test
 - [ ] changelog
 - [ ] squash
 - [ ] merge
 - [ ] delete branch
 ```

## Things to do in PR

 - update `CHANGELOG` file whenever there is new fix
 - update `UPGRADE` file whenever there is new features
