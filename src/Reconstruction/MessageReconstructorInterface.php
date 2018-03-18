<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Reconstruction;

use Qlimix\MessageBus\Message\MessageInterface;

interface MessageReconstructorInterface
{
    /**
     * @param string $message
     *
     * @return MessageInterface
     */
    public function reconstruct(string $message): MessageInterface;

    /**
     * @param string $message
     * @param string $objectName
     */
    public function registerMessage(string $message, string $objectName): void;
}
