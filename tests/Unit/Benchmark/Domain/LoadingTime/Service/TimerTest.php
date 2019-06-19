<?php
declare(strict_types=1);

namespace App\Tests\Unit\Benchmark\Domain\LoadingTime\Service;

use App\Benchmark\Domain\Exception\InvalidTimerException;
use App\Benchmark\Domain\LoadingTime\Service\Timer;
use App\Tests\Unit\UnitTestBase;

class TimerTest extends UnitTestBase
{
    public function testThatItReturnsProperStartAndStopValues(): void
    {
        $timer = new Timer();
        $timer->start();
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
        $timer = new Timer();

        $timer->start();
        $start = $timer->getStart();

        $timer->stop();
        $stop = $timer->getStop();

        $expected = round(($stop - $start) * 100, 10);
        $this->assertEquals($expected, $timer->getTimeInMilSeconds(10));
    }

    public function testThatItThrowsExceptionWhenTimerNotStopped(): void
    {
        $this->expectException(InvalidTimerException::class);

        $timer = new Timer();
        $timer->start();

        $timer->getTimeInMilSeconds();
    }

    public function testThatItThrowsExceptionWhenTimerNotStarted(): void
    {
        $this->expectException(InvalidTimerException::class);

        $timer = new Timer();
        $timer->stop();

        $timer->getTimeInMilSeconds();
    }
}