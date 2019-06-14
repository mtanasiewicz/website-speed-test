<?php
declare(strict_types=1);

namespace App\Tests\Unit\Benchmark\Domain\Report\Service\SimpleLoadingTimeReport;

use App\Benchmark\Domain\LoadingTime\Model\AllTimes;
use App\Benchmark\Domain\LoadingTime\Model\LoadingTime;
use App\Benchmark\Domain\Report\Service\SimpleLoadingTimeReport\DateSectionFactory;
use App\Benchmark\Domain\Report\Service\SimpleLoadingTimeReport\FailureSectionFactory;
use App\Benchmark\Domain\Report\Service\SimpleLoadingTimeReport\FasterThanBenchmarkSectionFactory;
use App\Benchmark\Domain\Report\Service\SimpleLoadingTimeReport\InfoSectionFactory;
use App\Benchmark\Domain\Report\Service\SimpleLoadingTimeReport\ReportFactory;
use App\Tests\Unit\UnitTestBase;

class ReportFactoryTest extends UnitTestBase
{
    /**
     * @var ReportFactory
     */
    private $reportFactory;

    protected function setUp()
    {
        parent::setUp();

        //No need for mocks
        $this->reportFactory = new ReportFactory(
            new InfoSectionFactory(),
            new FasterThanBenchmarkSectionFactory(),
            new FailureSectionFactory(),
            new DateSectionFactory()
        );
    }

    public function testThatItCreatesReport(): void
    {
        $allTimes = $this->createAllTimes(true);

        $report = $this->reportFactory->create($allTimes);
        $sections = $report->getSections();

        $this->assertSame(InfoSectionFactory::SECTION_TITLE, $sections[0]->getTitle());
        $this->assertCount(3, $sections[0]->getData());

        $this->assertSame(FasterThanBenchmarkSectionFactory::SECTION_TITLE, $sections[1]->getTitle());
        $this->assertCount(1, $sections[1]->getData());

        $this->assertSame(FailureSectionFactory::SECTION_TITLE, $sections[2]->getTitle());
        $this->assertCount(1, $sections[2]->getData());

        $this->assertSame(DateSectionFactory::SECTION_TITLE, $sections[3]->getTitle());
        $this->assertCount(1, $sections[3]->getData());

        $this->assertSame(ReportFactory::REPORT_NAME, $report->getName());
    }

    public function testThatItDoesntCreateFailureSectionWhenNotNeeded(): void
    {
        $allTimes = $this->createAllTimes(false);

        $report = $this->reportFactory->create($allTimes);

        foreach ($report->getSections() as $section) {
            $this->assertNotEquals(FailureSectionFactory::SECTION_TITLE, $section->getTitle());
        }
    }

    public function createAllTimes(bool $withFailure): AllTimes
    {
        $allTimes = new AllTimes(new LoadingTime('benchmark', 5.0));

        $allTimes->addComparedLoadingTime(new LoadingTime('faster', 4.0));
        $allTimes->addComparedLoadingTime(new LoadingTime('slower', 6.0));

        if ($withFailure) {
            $allTimes->addFailure('failure', 'failure-message');
        }

        return $allTimes;
    }
}