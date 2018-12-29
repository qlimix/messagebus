<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Registry;

use Qlimix\MessageBus\Registry\Dto\Handler;
use Qlimix\MessageBus\Registry\Exception\HandlerProviderException;

interface HandlersProviderInterface
{
    /**
     * @param string $messageName
     *
     * @return Handler[]
     *
     * @throws HandlerProviderException
     */
    public function find(string $messageName): array;
}
