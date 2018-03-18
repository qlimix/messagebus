<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Message\Retry;

use Qlimix\MessageBus\Message\MessageInterface;

interface RetryInterface
{
    /**
     * @param int $retryCount
     *
     * @return MessageInterface
     */
    public function withRetryCount(int $retryCount): MessageInterface;

    /**
     * @param \DateTimeImmutable $retryUntilTime
     *
     * @return static
     */
    public function withRetryUntilTime(\DateTimeImmutable $retryUntilTime = null);

    /**
     * @param \DateInterval $retryInterval
     *
     * @return static
     */
    public function withRetryInterval(\DateInterval $retryInterval = null);

    /**
     * @return bool
     */
    public function retry(): bool;

    /**
     * @return \DateTimeImmutable|null
     */
    public function getRetryTime(): ?\DateTimeImmutable;

    /**
     * Account for a retry
     */
    public function retried(): void;

    /**
     * Get number of retries.
     *
     * @return int
     */
    public function getRetries(): int;
}
