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
    public const REPORT_NAME = 'WEBSITE LOADING TIME BENCHMARK';

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
     * @var DateSectionFactory
     */
    private $dateSectionFactory;

    /**
     * ReportFactory constructor.
     * @param InfoSectionFactory $infoSectionFactory
     * @param FasterThanBenchmarkSectionFactory $fasterThanBenchmarkSectionFactory
     * @param FailureSectionFactory $failureSectionFactory
     * @param DateSectionFactory $dateSectionFactory
     */
    public function __construct(
        InfoSectionFactory $infoSectionFactory,
        FasterThanBenchmarkSectionFactory $fasterThanBenchmarkSectionFactory,
        FailureSectionFactory $failureSectionFactory,
        DateSectionFactory $dateSectionFactory
    )
    {
        $this->infoSectionFactory = $infoSectionFactory;
        $this->fasterThanBenchmarkSectionFactory = $fasterThanBenchmarkSectionFactory;
        $this->failureSectionFactory = $failureSectionFactory;
        $this->dateSectionFactory = $dateSectionFactory;
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

        $dateSection = $this->dateSectionFactory->create($report->getCreatedAt());
        $report->addSection($dateSection);

        return $report;
    }
}