<?php
declare(strict_types=1);

namespace App\Tests\Unit\Benchmark\Domain\LoadingTime\Service;

use App\Benchmark\Domain\LoadingTime\Model\LoadingTime;
use App\Benchmark\Domain\LoadingTime\Service\LoadingTimeFactory;
use App\Benchmark\Domain\LoadingTime\Service\Timer;
use App\Benchmark\Domain\LoadingTime\Service\TimerFactory;
use App\Benchmark\Infrastructure\Connection\WebConnector;
use App\Tests\Unit\UnitTestBase;
use PHPUnit\Framework\MockObject\MockObject;

class LoadingTimeFactoryTest extends UnitTestBase
{
    private const URL = 'www.example.com';

    /**
     * @var WebConnector|MockObject
     */
    private $webConnector;
    /**
     * @var LoadingTimeFactory
     */
    private $loadingTimeFactory;
    /**
     * @var TimerFactory|MockObject
     */
    private $timerFactory;
    /**
     * @var Timer|MockObject
     */
    private $timer;

    public function setUp()
    {
        parent::setUp();

        $this->webConnector = $this->createMock(WebConnector::class);
        $this->timerFactory = $this->createMock(TimerFactory::class);
        $this->loadingTimeFactory = new LoadingTimeFactory($this->webConnector, $this->timerFactory);
        $this->timer = $this->createMock(Timer::class);

        $this->timerFactory
            ->method('create')
            ->willReturn($this->timer);
    }

    public function testItCreatesLoadingTime(): void
    {
        $this->webConnector
            ->method('connect')
            ->with(self::URL);

        $this->timer
            ->expects($this->once())
            ->method('start');

        $this->timer
            ->expects($this->once())
            ->method('stop');

        $this->timer
            ->expects($this->once())
            ->method('getTimeInMilSeconds')
            ->willReturn(2.0);

        $loadingTime = $this->loadingTimeFactory->create(self::URL);

        $this->assertInstanceOf(LoadingTime::class, $loadingTime);
        $this->assertInternalType('float', $loadingTime->getValue());
        $this->assertEquals(2.0, $loadingTime->getValue());
        $this->assertSame(self::URL, $loadingTime->getName());
    }
}