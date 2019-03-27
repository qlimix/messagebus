<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Registry;

use Qlimix\MessageBus\Registry\Dto\Handler;
use Qlimix\MessageBus\Registry\Exception\HandlerProviderException;

interface HandlerProviderInterface
{
    /**
     * @throws HandlerProviderException
     */
    public function find(string $messageName): Handler;
}
