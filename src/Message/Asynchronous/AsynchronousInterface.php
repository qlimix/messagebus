<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Message\Asynchronous;

interface AsynchronousInterface
{
    /**
     * @return bool
     */
    public function isAsynchronous(): bool;

    /**
     * @return static
     */
    public function withAsynchronous();
}
