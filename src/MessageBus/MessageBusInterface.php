<?php declare(strict_types=1);

namespace Qlimix\MessageBus;

use Qlimix\MessageBus\Message\MessageInterface;

interface MessageBusInterface
{
    /**
     * @param MessageInterface $message
     */
    public function handle(MessageInterface $message): void;
}
