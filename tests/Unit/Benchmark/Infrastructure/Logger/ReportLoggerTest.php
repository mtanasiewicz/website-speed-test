<?php
declare(strict_types=1);

namespace App\Tests\Unit\Benchmark\Infrastructure\Logger;

use App\Benchmark\Domain\Report\Model\Report;
use App\Benchmark\Infrastructure\Logger\Conversion\ReportConverter;
use App\Benchmark\Infrastructure\Logger\ReportLogger;
use App\Benchmark\Infrastructure\Logger\ReportLoggerInterface;
use App\Shared\Infrastructure\Logger\Logger;
use App\Tests\Unit\UnitTestBase;
use PHPUnit\Framework\MockObject\MockObject;

class ReportLoggerTest extends UnitTestBase
{
    /**
     * @var MockObject|ReportConverter
     */
    private $reportConverter;
    /**
     * @var MockObject|Logger
     */
    private $txtLogger;
    /**
     * @var ReportLoggerInterface
     */
    private $reportLogger;

    protected function setUp()
    {
        parent::setUp();

        $this->reportConverter = $this->createMock(ReportConverter::class);
        $this->txtLogger = $this->createMock(Logger::class);
        $this->reportLogger = new ReportLogger($this->reportConverter, $this->txtLogger);
    }

    public function testThatItLogsReport(): void
    {
        $report = new Report('some-report', []);
        $convertedReport = 'converted-report';

        $this->reportConverter
            ->expects($this->once())
            ->method('convert')
            ->with($report)
            ->willReturn($convertedReport);

        $this->txtLogger
            ->expects($this->once())
            ->method('info')
            ->with($convertedReport);

        $this->reportLogger->log($report);
    }
}