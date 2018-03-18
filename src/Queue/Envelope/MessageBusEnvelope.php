<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Queue\Envelope;

use Qlimix\Queue\Envelope\EnvelopeInterface;
use Qlimix\Queue\Message\MessageInterface;

final class MessageBusEnvelope implements EnvelopeInterface
{
    private const ROUTE = 'qlimix.messagebus.queue.envelope';

    /** @var MessageInterface */
    private $message;

    /**
     * @param MessageInterface $message
     */
    public function __construct(MessageInterface $message)
    {
        $this->message = $message;
    }

    /**
     * @inheritDoc
     */
    public function getRoute(): string
    {
        return self::ROUTE;
    }

    /**
     * @inheritDoc
     */
    public function getMessage(): MessageInterface
    {
        return $this->message;
    }
}
