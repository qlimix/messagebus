<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Message\Retry;

interface RetryInterface
{
    /**
     * @param int $retryCount
     *
     * @return static
     */
    public function withRetryCount(int $retryCount);

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

    public function retried(): void;

    /**
     * Get count number of retries.
     *
     * @return int
     */
    public function getCountRetried(): int;
}
