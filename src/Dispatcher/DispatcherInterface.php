<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Dispatcher;

use Qlimix\MessageBus\Dispatcher\Exception\DispatcherException;

interface DispatcherInterface
{
    /**
     * @param mixed $message
     *
     * @throws DispatcherException
     */
    public function dispatch($message): void;
}
