<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\LoadingTime\Service;

use App\Benchmark\Domain\Exception\TimerNotStoppedException;

/**
 * Class Timer
 * @package App\Benchmark\Domain\LoadingTime\Service
 */
class Timer
{
    /**
     * @var float
     */
    private $start;
    /**
     * @var float
     */
    private $stop = 0;

    /**
     * Timer constructor.
     */
    private function __construct()
    {
        $this->start = microtime(true);
    }

    /**
     * @return Timer
     */
    public static function start(): self
    {
        return new self();
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
        if (0 === $this->stop) {
            throw new TimerNotStoppedException('Please stop the timer before reading this value');
        }

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
}