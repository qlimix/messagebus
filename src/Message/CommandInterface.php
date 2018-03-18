<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Message;

use Qlimix\MessageBus\Message\Asynchronous\AsynchronousInterface;
use Qlimix\MessageBus\Message\Retry\RetryInterface;

interface CommandInterface extends MessageInterface, RetryInterface, AsynchronousInterface
{
}
