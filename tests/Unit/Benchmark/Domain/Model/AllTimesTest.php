<?php
declare(strict_types=1);

namespace App\Tests\Unit\Benchmark\Domain\Model;

use App\Benchmark\Domain\LoadingTime\Model\AllTimes;
use App\Benchmark\Domain\LoadingTime\Model\LoadingTime;
use App\Tests\Unit\UnitTestBase;

/**
 * Class AllTimesTest
 * @package App\Tests\Unit\Benchmark\Domain\Model
 */
class AllTimesTest extends UnitTestBase
{
    public function testThatItReturnsBenchmarkTimeAtFirstPositionInAllTimes(): void
    {
        $benchmarkTime = new LoadingTime('benchmark', 1);

        $allTimes = new AllTimes($benchmarkTime);
        $allTimes->addComparedLoadingTime(new LoadingTime('other', 1));
        $times = $allTimes->getAllTimes();

        $this->assertSame($benchmarkTime, $times[0]);
    }

    public function testThatItReturnsTimesFasterThanBenchmarkTime(): void
    {
        $allTimes = $this->createAllTimes(2, 1.5);

        $this->assertCount(1, $allTimes->getTimesFasterThanBenchmark());
        $this->assertCount(0, $allTimes->getTimesTwoTimesFasterThanBenchmark());
    }

    public function testThatItReturnsTimesTwoTimesFasterThanBenchmarkTime(): void
    {
        $allTimes = $this->createAllTimes(2, 1);

        $this->assertCount(1, $allTimes->getTimesFasterThanBenchmark());
        $this->assertCount(1, $allTimes->getTimesTwoTimesFasterThanBenchmark());
    }

    public function testThatItReturnsNoFasterTimesThanBenchmarkTime(): void
    {
        $allTimes = $this->createAllTimes(1, 2);

        $this->assertCount(0, $allTimes->getTimesFasterThanBenchmark());
        $this->assertCount(0, $allTimes->getTimesTwoTimesFasterThanBenchmark());
    }

    /**
     * @param float $benchmarkTime
     * @param float $comparedTime
     * @return AllTimes
     */
    private function createAllTimes(float $benchmarkTime, float $comparedTime): AllTimes
    {
        $allTimes = new AllTimes(new LoadingTime('benchmark', $benchmarkTime));
        $allTimes->addComparedLoadingTime(new LoadingTime('faster1', $comparedTime));

        return $allTimes;
    }
}