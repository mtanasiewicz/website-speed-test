<?php
declare(strict_types=1);

namespace App\Tests\Unit\Benchmark\Domain\LoadingTime\Service;

use App\Benchmark\Domain\Exception\TimerNotStoppedException;
use App\Benchmark\Domain\LoadingTime\Service\Timer;
use App\Tests\Unit\UnitTestBase;

class TimerTest extends UnitTestBase
{
    public function testThatItReturnsProperStartAndStopValues(): void
    {
        $timer = Timer::start();
        $start = $timer->getStart();

        $stopBeforeTimerStopped = $timer->getStop();
        $timer->stop();
        $stopAfterTimerStopped = $timer->getStop();

        $this->assertEquals(0, $stopBeforeTimerStopped);
        $this->assertNotEquals(0, $stopAfterTimerStopped);
        $this->assertNotEquals(0, $start);
    }

    public function testThatItMeasuresTimeFlowInMilliSeconds(): void
    {
        $timer = Timer::start();
        $start = $timer->getStart();

        $timer->stop();
        $stop = $timer->getStop();

        $expected = ($stop - $start) * 100;
        $this->assertEquals($expected, $timer->getTimeInMilSeconds());
    }

    public function testThatItThrowsExceptionWhenTimerNotStopped(): void
    {
        $this->expectException(TimerNotStoppedException::class);

        $timer = Timer::start();
        $timer->getTimeInMilSeconds();
    }
}