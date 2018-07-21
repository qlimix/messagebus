<?php declare(strict_types=1);

namespace Qlimix\MessageBus\MessageBus;

interface MessageBusInterface
{
    /**
     * @param mixed $message
     */
    public function handle($message): void;
}
