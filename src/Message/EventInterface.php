<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Message;

use Qlimix\MessageBus\Message\Asynchronous\AsynchronousInterface;
use Qlimix\MessageBus\Message\Retry\RetryInterface;
use Qlimix\MessageBus\MessageBusInterface;

interface EventInterface extends MessageBusInterface, AsynchronousInterface, RetryInterface
{
}
