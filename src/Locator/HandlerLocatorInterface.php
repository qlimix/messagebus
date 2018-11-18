<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Locator;

use Qlimix\MessageBus\Locator\Dto\ExecutableHandler;
use Qlimix\MessageBus\Locator\Exception\LocatorException;

interface HandlerLocatorInterface
{
    /**
     * @param string $messageId
     *
     * @return ExecutableHandler[]
     *
     * @throws LocatorException
     */
    public function locate(string $messageId): array;
}
