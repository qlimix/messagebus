<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Message;

interface MessageInterface
{
    /**
     * @return string
     */
    public function getId(): string;

    /**
     * A unique message name with application naming space.
     * This is used to deserialize the message back into
     *  the message scheme object on the processing side.
     *
     * For example: A message object is called 'HelloWorldCommand'
     * This method would return namespace.domain.command.hello_world
     *  or a similar construction.
     *
     * A message reconstructing service could lookup the message name
     *  and build up the message on their side.
     *
     * Preferably this would be language independent.
     *
     * @return string
     */
    public static function getName(): string;

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
