<?php declare(strict_types=1);

namespace Qlimix\MessageBus\Message\Schedule;

interface SchedulerInterface
{
    /**
     * @param \DateTimeImmutable $scheduleTime
     *
     * @return static
     */
    public function withScheduleTime(\DateTimeImmutable $scheduleTime = null);

    /**
     * @return static
     */
    public function removeScheduleTime();

    /**
     * @return bool
     */
    public function isScheduled(): bool;

    /**
     * @return \DateTimeImmutable|null
     */
    public function getScheduleTime(): ?\DateTimeImmutable;
}
