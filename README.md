# Messagebus

[![Travis CI](https://api.travis-ci.org/qlimix/messagebus.svg?branch=master)](https://travis-ci.org/qlimix/messagebus)
[![Coveralls](https://img.shields.io/coveralls/github/qlimix/messagebus.svg)](https://coveralls.io/github/qlimix/messagebus)
[![Packagist](https://img.shields.io/packagist/v/qlimix/messagebus.svg)](https://packagist.org/packages/qlimix/messagebus)
[![MIT License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](https://github.com/qlimix/messagebus/blob/master/LICENSE)

Sending messages through your system with messagebus.

## Install

Using Composer:

~~~
$ composer require qlimix/messagebus
~~~

## usage

```php
<?php

use Qlimix\MessageBus\MessageBus\MiddlewareMessageBus;

$middleware = [];
$dispatcher = new FooBarDispatcher();

$messageBus = new MiddlewareMessageBus($middleware, $dispatcher);

$messageBus->handle(new Message($foo, $bar));
```

## Testing
To run all unit tests locally with PHPUnit:

~~~
$ vendor/bin/phpunit
~~~

## Quality
To ensure code quality run grumphp which will run all tools:

~~~
$ vendor/bin/grumphp run
~~~

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.
