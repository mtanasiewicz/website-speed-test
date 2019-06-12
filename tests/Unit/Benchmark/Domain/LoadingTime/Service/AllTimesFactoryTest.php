<?php
declare(strict_types=1);

namespace App\Tests\Unit\Benchmark\Domain\LoadingTime\Service;

use App\Benchmark\Domain\Exception\UnableToCreateBenchmarkException;
use App\Benchmark\Domain\LoadingTime\Model\LoadingTime;
use App\Benchmark\Domain\LoadingTime\Service\AllTimesFactory;
use App\Benchmark\Domain\LoadingTime\Service\LoadingTimeFactory;
use App\Tests\Unit\UnitTestBase;
use Exception;

class AllTimesFactoryTest extends UnitTestBase
{
    private const COMPARED_URLS = [
        'www.example.com',
        'www.google.com',
        'www.wp.pl',
    ];

    /**
     * @var LoadingTimeFactory|\PHPUnit_Framework_MockObject_MockObject
     */
    private $loadingTimeFactory;
    /**
     * @var AllTimesFactory
     */
    private $allTimesFactory;

    public function setUp()
    {
        parent::setUp();

        $this->loadingTimeFactory = $this->createMock(LoadingTimeFactory::class);
        $this->allTimesFactory = new AllTimesFactory($this->loadingTimeFactory);
    }

    public function testItCreatesAllTimes(): void
    {
        $benchmarkUrl = self::COMPARED_URLS[0];
        $comparedUrls = $this->removeBenchmarkUrlFromCompared();

        $this->loadingTimeFactory
            ->method('create')
            ->will($this->onConsecutiveCalls(
                new LoadingTime($benchmarkUrl, 1),
                new LoadingTime($comparedUrls[0], 2),
                new LoadingTime($comparedUrls[1], 3)
            ));


        $allTimes = $this->allTimesFactory->create($benchmarkUrl, $comparedUrls);
        $benchmarkTime = $allTimes->getBenchmarkTime();
        $comparedTimes = $allTimes->getComparedTimes();

        $this->assertInstanceOf(LoadingTime::class, $benchmarkTime);
        $this->assertContainsOnlyInstancesOf(LoadingTime::class, $comparedTimes);
        $this->assertEquals(1, $benchmarkTime->getValue());
        $this->assertSame($benchmarkUrl, $benchmarkTime->getName());

        $this->assertEquals(2, $comparedTimes[0]->getValue());
        $this->assertSame($comparedUrls[0], $comparedTimes[0]->getName());

        $this->assertEquals(3, $comparedTimes[1]->getValue());
        $this->assertSame($comparedUrls[1], $comparedTimes[1]->getName());
    }

    public function testItThrowsExceptionWhenBenchmarkLoadingTimeCreationThrowsException(): void
    {
        $this->expectException(UnableToCreateBenchmarkException::class);
        $benchmarkUrl = self::COMPARED_URLS[0];
        $comparedUrls = $this->removeBenchmarkUrlFromCompared();

        $this->loadingTimeFactory
            ->method('create')
            ->will(
                $this->onConsecutiveCalls(
                    $this->throwException(new Exception('message')),
                    new LoadingTime($benchmarkUrl, 1),
                    new LoadingTime($comparedUrls[1], 3)
                )
            );

        $this->allTimesFactory->create($benchmarkUrl, $comparedUrls);
    }

    public function testItCreatesFailureWhenLoadingTimeFactoryThrowsExceptionOnComparedTimes(): void
    {
        $benchmarkUrl = self::COMPARED_URLS[0];
        $comparedUrls = $this->removeBenchmarkUrlFromCompared();

        $this->loadingTimeFactory
            ->method('create')
            ->will(
                $this->onConsecutiveCalls(
                    new LoadingTime($benchmarkUrl, 1),
                    $this->throwException(new Exception('message')),
                    new LoadingTime($comparedUrls[1], 3)
                )
            );

        $allTimes = $this->allTimesFactory->create($benchmarkUrl, $comparedUrls);

        $this->assertSame([$comparedUrls[0] => 'message'], $allTimes->getFailures());
    }

    /**
     * @return array
     */
    private function removeBenchmarkUrlFromCompared(): array
    {
        $comparedUrls = self::COMPARED_URLS;
        unset($comparedUrls[0]);

        return array_values($comparedUrls);
    }
}