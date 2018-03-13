<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Message;

use Qlimix\MessageBus\Message\Asynchronous\AsynchronousInterface;
use Qlimix\MessageBus\Message\Retry\RetryInterface;
use Qlimix\MessageBus\Message\Schedule\SchedulerInterface;

interface CommandInterface extends SchedulerInterface, RetryInterface, AsynchronousInterface
{
}
