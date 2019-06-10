<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\Report\Service\SimpleLoadingTimeReport;

use App\Benchmark\Domain\LoadingTime\Model\AllTimes;
use App\Benchmark\Domain\Report\Model\Report;
use App\Benchmark\Domain\Report\Service\ReportFactory as ReportFactoryInterface;

/**
 * Class ReportFactory
 * @package App\Benchmark\Domain\Report\Service\SimpleLoadingTimeReport
 */
class ReportFactory implements ReportFactoryInterface
{
    private const REPORT_NAME = 'WEBSITE LOADING TIME BENCHMARK';

    /**
     * @var InfoSectionFactory
     */
    private $infoSectionFactory;
    /**
     * @var FasterThanBenchmarkSectionFactory
     */
    private $fasterThanBenchmarkSectionFactory;
    /**
     * @var FailureSectionFactory
     */
    private $failureSectionFactory;

    /**
     * ReportFactory constructor.
     * @param InfoSectionFactory $infoSectionFactory
     * @param FasterThanBenchmarkSectionFactory $fasterThanBenchmarkSectionFactory
     * @param FailureSectionFactory $failureSectionFactory
     */
    public function __construct(
        InfoSectionFactory $infoSectionFactory,
        FasterThanBenchmarkSectionFactory $fasterThanBenchmarkSectionFactory,
        FailureSectionFactory $failureSectionFactory
    )
    {
        $this->infoSectionFactory = $infoSectionFactory;
        $this->fasterThanBenchmarkSectionFactory = $fasterThanBenchmarkSectionFactory;
        $this->failureSectionFactory = $failureSectionFactory;
    }

    /**
     * @param AllTimes $allTimes
     * @return Report
     */
    public function create(AllTimes $allTimes): Report
    {
        $infoSection = $this->infoSectionFactory->create($allTimes);

        $fasterThanBenchmarkSection = $this->fasterThanBenchmarkSectionFactory->create($allTimes);

        $report = new Report(self::REPORT_NAME, [$infoSection, $fasterThanBenchmarkSection]);

        $failureSection = $this->failureSectionFactory->create($allTimes);
        if (!$failureSection->isEmpty()) {
            $report->addSection($failureSection);
        }

        return $report;
    }
}