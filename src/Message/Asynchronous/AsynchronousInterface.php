<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Message\Asynchronous;

use Qlimix\MessageBus\Message\MessageInterface;

interface AsynchronousInterface
{
    /**
     * @return bool
     */
    public function isAsynchronous(): bool;

    /**
     * @return MessageInterface
     */
    public function withAsynchronous(): MessageInterface;

    /**
     * @return MessageInterface
     */
    public function withSynchronous(): MessageInterface;
}
