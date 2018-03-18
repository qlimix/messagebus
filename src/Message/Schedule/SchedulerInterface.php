<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Message\Schedule;

use Qlimix\MessageBus\Message\MessageInterface;

interface SchedulerInterface
{
    /**
     * @param \DateTimeImmutable $scheduleTime
     *
     * @return static
     */
    public function withScheduleTime(\DateTimeImmutable $scheduleTime = null);

    /**
     * @return MessageInterface
     */
    public function removeScheduleTime(): MessageInterface;

    /**
     * @return bool
     */
    public function isScheduled(): bool;

    /**
     * @return \DateTimeImmutable|null
     */
    public function getScheduleTime(): ?\DateTimeImmutable;
}
