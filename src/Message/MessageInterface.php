<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Message;

interface MessageInterface
{
    /**
     * A unique message name with application naming space.
     * This is used to deserialize the message back into
     *  the message scheme object on the processing side.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * @return array
     */
    public function serialize(): array;

    /**
     * @param array $data
     *
     * @return MessageInterface
     */
    public static function deserialize(array $data): MessageInterface;
}
