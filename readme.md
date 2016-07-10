# Extended

Classes and interfaces that expand some concepts from the SPL that I find I
use across many projects. Basic data structures and their usages are implemented
throughout this library.

## Testing

There are two ways to test the Extended package.

### Locally

`Extended` Supports PHP 5.6 and up.

    $ composer install
    $ ./vendor/bin/phpunit

### Virtually

The virtual environment is an Ubuntu 14.04 installation using PHP7.

    [local] $ vagrant up --provision
    [local] $ vagrant ssh
    [vagrant] $ cd /vagrant
    [vagrant] $ composer install
    [vagrant] $ ./vendor/bin/phpunit
