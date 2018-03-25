<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Message;

trait GetNameTrait
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return \get_class($this);
    }
}
