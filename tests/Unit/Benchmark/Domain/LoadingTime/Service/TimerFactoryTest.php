<?php

declare(strict_types=1);

namespace App\Tests\Unit\Benchmark\Domain\LoadingTime\Service;

use App\Benchmark\Domain\LoadingTime\Service\Timer;
use App\Benchmark\Domain\LoadingTime\Service\TimerFactory;
use App\Tests\Unit\UnitTestBase;

/**
 * Class TimerFactoryTest
 * @package App\Tests\Unit\Benchmark\Domain\LoadingTime\Service
 */
class TimerFactoryTest extends UnitTestBase
{
    public function testThatItCreatesWithDefaultValues(): void
    {
        $timer = (new TimerFactory())->create();

        $this->assertInstanceOf(Timer::class, $timer);
        $this->assertEquals(0, $timer->getStart());
        $this->assertEquals(0, $timer->getStop());
    }
}
