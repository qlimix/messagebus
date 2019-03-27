<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Locator;

use Qlimix\MessageBus\Locator\Dto\ExecutableHandler;
use Qlimix\MessageBus\Locator\Exception\LocatorException;

interface HandlerLocatorInterface
{
    /**
     * @return ExecutableHandler[]
     *
     * @throws LocatorException
     */
    public function locate(string $messageId): array;
}
