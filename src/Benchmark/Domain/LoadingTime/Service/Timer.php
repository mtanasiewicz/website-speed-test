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
     * @var mixed
     */
    private $start;
    /**
     * @var int
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
     * @return float
     */
    public function getTimeInMilSeconds(): float
    {
        if (0 === $this->stop) {
            throw new TimerNotStoppedException('Please stop the timer before reading the value');
        }

        return ($this->stop - $this->start) * 100;
    }
}