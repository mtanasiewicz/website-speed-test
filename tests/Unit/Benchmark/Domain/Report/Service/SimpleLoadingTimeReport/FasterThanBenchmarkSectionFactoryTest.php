<?php
declare(strict_types=1);

namespace App\Tests\Unit\Benchmark\Domain\Report\Service\SimpleLoadingTimeReport;

use App\Benchmark\Domain\LoadingTime\Model\AllTimes;
use App\Benchmark\Domain\LoadingTime\Model\LoadingTime;
use App\Benchmark\Domain\Report\Service\SimpleLoadingTimeReport\FasterThanBenchmarkSectionFactory;
use App\Tests\Unit\UnitTestBase;

class FasterThanBenchmarkSectionFactoryTest extends UnitTestBase
{
    /**
     * @var FasterThanBenchmarkSectionFactory
     */
    private $fasterThanBenchmarkSectionFactory;

    public function setUp()
    {
        parent::setUp();

        $this->fasterThanBenchmarkSectionFactory = new FasterThanBenchmarkSectionFactory();
    }

    public function testThatItCreatesSectionWithFasterLoadingTimes(): void
    {
        $allTimes = $this->createAllTimes();

        $fasterThanBenchmarkSection = $this->fasterThanBenchmarkSectionFactory->create($allTimes);
        $data = $fasterThanBenchmarkSection->getData();

        $this->assertSame('faster1', $data[0]->getName());
        $this->assertSame('faster2', $data[1]->getName());
        $this->assertEquals(4.0, $data[0]->getValue());
        $this->assertEquals(4.99, $data[1]->getValue());
        $this->assertCount(2, $data);
        $this->assertSame(FasterThanBenchmarkSectionFactory::SECTION_TITLE, $fasterThanBenchmarkSection->getTitle());
    }

    /**
     * @return AllTimes
     */
    private function createAllTimes(): AllTimes
    {
        $allTimes = new AllTimes(new LoadingTime('benchmark', 5.0));
        $allTimes->addComparedLoadingTime(new LoadingTime('faster1', 4.0));
        $allTimes->addComparedLoadingTime(new LoadingTime('faster2', 4.99));
        $allTimes->addComparedLoadingTime(new LoadingTime('slower', 5.01));

        return $allTimes;
    }
}