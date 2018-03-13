<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Locator;

use Qlimix\MessageBus\Locator\Exception\ServiceLocatorException;

interface ServiceLocatorInterface
{
    /**
     * @param string $service
     *
     * @return mixed
     *
     * @throws ServiceLocatorException
     */
    public function resolve(string $service);
}
