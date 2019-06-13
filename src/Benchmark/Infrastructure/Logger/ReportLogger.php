<?php
declare(strict_types=1);

namespace App\Benchmark\Infrastructure\Logger;

use App\Benchmark\Domain\Report\Model\Report;
use App\Benchmark\Infrastructure\Logger\Conversion\ReportConverter;
use App\Shared\Infrastructure\Logger\Logger;

class ReportLogger implements ReportLoggerInterface
{
    /**
     * @var ReportConverter
     */
    private $reportConverter;
    /**
     * @var Logger
     */
    private $logger;

    public function __construct(ReportConverter $logConverter, Logger $txtLogger)
    {
        $this->reportConverter = $logConverter;
        $this->logger = $txtLogger;
    }

    public function log(Report $report): void
    {
        $convertedReport = $this->reportConverter->convert($report);

        $this->logger->info($convertedReport);
    }
}