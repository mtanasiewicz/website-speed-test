<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\LoadingTime\Service;

use App\Benchmark\Domain\Exception\TimerNotStoppedException;

class Timer
{
    /** @var float */
    private $start;

    /** @var float */
    private $stop = 0;

    private function __construct()
    {
        $this->start = microtime(true);
    }

    public static function start(): self
    {
        return new self();
    }

    public function stop(): void
    {
        $this->stop = microtime(true);
    }

    /**
     * @throws TimerNotStoppedException
     */
    public function getTimeInMilSeconds(): float
    {
        if (0 === $this->stop) {
            throw new TimerNotStoppedException('Please stop the timer before reading the value');
        }

        return ($this->stop - $this->start) * 100;
    }
}