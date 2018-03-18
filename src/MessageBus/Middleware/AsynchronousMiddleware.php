<?php declare(strict_types=1);

namespace Qlimix\MessageBus\MessageBus\Middleware;

use Qlimix\Id\Generator\UUID\UUID4Generator;
use Qlimix\MessageBus\Message\Asynchronous\AsynchronousInterface;
use Qlimix\MessageBus\Message\MessageInterface;
use Qlimix\MessageBus\MessageBus\Middleware\Exception\MiddlewareException;
use Qlimix\MessageBus\Queue\Envelope\MessageBusEnvelope;
use Qlimix\MessageBus\Queue\Message\MessageBusMessage;
use Qlimix\Queue\Producer\ProducerInterface;

final class AsynchronousMiddleware implements MiddlewareInterface
{
    /** @var ProducerInterface */
    private $producer;

    /** @var UUID4Generator */
    private $uuid4Generator;

    /**
     * @param ProducerInterface $producer
     * @param UUID4Generator $uuid4Generator
     */
    public function __construct(ProducerInterface $producer, UUID4Generator $uuid4Generator)
    {
        $this->producer = $producer;
        $this->uuid4Generator = $uuid4Generator;
    }

    /**
     * @inheritDoc
     */
    public function handle(MessageInterface $message, MiddlewareHandlerInterface $handler): void
    {
        if ($message instanceof AsynchronousInterface && $message->isAsynchronous()) {
           $asyncMessage = $message->withSynchronous();

           try {
               $this->producer->publish(new MessageBusEnvelope(
                   new MessageBusMessage(
                       $this->uuid4Generator->generate()->getUuid4(),
                       $asyncMessage->serialize()
                   )
               ));
           } catch (\Throwable $exception) {
               throw new MiddlewareException('Could not handle message asynchronous', 0, $exception);
           }

           return;
        }

        $handler->next($message, $handler);
    }
}
