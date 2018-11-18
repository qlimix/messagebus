<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Dispatcher;

interface MessageDispatcherInterface
{
    /**
     * @param mixed $message
     */
    public function dispatch($message): void;
}
