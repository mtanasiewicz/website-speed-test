<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\LoadingTime\Service;

use App\Benchmark\Domain\Exception\InvalidTimerException;

/**
 * Class Timer
 * @package App\Benchmark\Domain\LoadingTime\Service
 */
class Timer
{
    /**
     * @var float
     */
    private $start = 0;
    /**
     * @var float
     */
    private $stop = 0;

    public function start(): void
    {
        $this->start = microtime(true);
    }

    public function stop(): void
    {
        $this->stop = microtime(true);
    }

    /**
     * @param int $precision
     * @return float
     */
    public function getTimeInMilSeconds(int $precision = 2): float
    {
        $this->assertTimerIsValid();

        $milliseconds = ($this->stop - $this->start) * 100;

        return round($milliseconds, $precision);
    }

    /**
     * @return float
     */
    public function getStart(): float
    {
        return $this->start;
    }

    /**
     * @return float
     */
    public function getStop(): float
    {
        return $this->stop;
    }


    private function assertTimerIsValid(): void
    {
        if ($this->stop === 0) {
            throw new InvalidTimerException('Please stop the timer before reading this value');
        }

        if ($this->start === 0) {
            throw new InvalidTimerException('Please start the timer before reading this value.');
        }
    }
}