<?php

declare(strict_types=1);

namespace App\Benchmark\Domain\LoadingTime\Service;

class TimerFactory
{
    public function create(): Timer
    {
        return new Timer();
    }
}
