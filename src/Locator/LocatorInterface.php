<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Locator;

use Qlimix\MessageBus\Locator\Dto\ExecutableHandler;
use Qlimix\MessageBus\Locator\Exception\LocatorException;

interface LocatorInterface
{
    /**
     * @param string $handler
     *
     * @return ExecutableHandler[]
     *
     * @throws LocatorException
     */
    public function locate(string $handler): array;
}
