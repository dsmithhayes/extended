# Exnteded

Classes and interfaces that expand some concepts from the SPL that I find I
use across many projects. Basic data structures and their usages are implemented
throughout this library.

## Testing

There are two ways to test the Extended package.

### Locally

    $ composer install
    $ ./vendor/bin/phpunit

### Virtually

    local$ vagrant up --provision
    local$ vagrant ssh
    vagrant$ cd /vagrant
    vagrant$ composer install
    vagrant$ ./vendor/bin/phpunit
