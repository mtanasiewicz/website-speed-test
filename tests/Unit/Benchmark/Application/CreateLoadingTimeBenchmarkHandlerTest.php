<?php
declare(strict_types=1);

namespace App\Tests\Unit\Benchmark\Application;

use App\Benchmark\Application\CreateLoadingTimeBenchmarkCommand;
use App\Benchmark\Application\CreateLoadingTimeBenchmarkHandler;
use App\Benchmark\Application\Helper\Notificator;
use App\Benchmark\Domain\LoadingTime\Model\AllTimes;
use App\Benchmark\Domain\LoadingTime\Model\LoadingTime;
use App\Benchmark\Domain\LoadingTime\Service\AllTimesFactory;
use App\Benchmark\Domain\Report\Model\Report;
use App\Benchmark\Domain\Report\Service\SimpleLoadingTimeReport\ReportFactory;
use App\Benchmark\Infrastructure\Logger\Conversion\ReportConverter;
use App\Benchmark\Infrastructure\Logger\ReportLoggerInterface;
use App\Tests\Unit\UnitTestBase;
use PHPUnit\Framework\MockObject\MockObject;

class CreateLoadingTimeBenchmarkHandlerTest extends UnitTestBase
{
    private const EMAIL = 'email@example.com';
    private const PHONE_NUMBER = '555-55-55';
    private const BENCHMARK_URL = 'example.com';
    private const COMPARED_URLS= ['example.net', 'example.io'];
    /**
     * @var MockObject|AllTimesFactory
     */
    private $allTimesFactory;
    /**
     * @var MockObject|ReportFactory
     */
    private $reportFactory;
    /**
     * @var MockObject|ReportConverter
     */
    private $reportConverter;
    /**
     * @var MockObject|Notificator
     */
    private $notificator;
    /**
     * @var MockObject|ReportLoggerInterface
     */
    private $reportLogger;
    /**
     * @var CreateLoadingTimeBenchmarkHandler
     */
    private $createLoadingTimeBenchmarkHandler;

    protected function setUp()
    {
        parent::setUp();

        $this->allTimesFactory = $this->createMock(AllTimesFactory::class);
        $this->reportFactory = $this->createMock(ReportFactory::class);
        $this->reportConverter = $this->createMock(ReportConverter::class);
        $this->notificator = $this->createMock(Notificator::class);
        $this->reportLogger = $this->createMock(ReportLoggerInterface::class);

        $this->createLoadingTimeBenchmarkHandler = new CreateLoadingTimeBenchmarkHandler(
            $this->allTimesFactory,
            $this->reportFactory,
            $this->reportConverter,
            $this->notificator,
            $this->reportLogger
        );
    }

    public function testHandlerFlow(): void
    {
        $command = new CreateLoadingTimeBenchmarkCommand(
            self::EMAIL,
            self::PHONE_NUMBER,
            self::BENCHMARK_URL,
            self::COMPARED_URLS
        );

        $allTimes = $this->createAllTimes();

        $this->allTimesFactory
            ->expects($this->once())
            ->method('create')
            ->with(self::BENCHMARK_URL, self::COMPARED_URLS)
            ->willReturn($allTimes);

        $this->notificator
            ->expects($this->once())
            ->method('notifyAboutFasterWebsites')
            ->with(self::EMAIL, self::PHONE_NUMBER, $allTimes);

        $report = $this->createReport();
        $this->reportFactory
            ->expects($this->once())
            ->method('create')
            ->willReturn($report);

        $this->reportLogger
            ->expects($this->once())
            ->method('log')
            ->with($report);

        $this->reportConverter
            ->expects($this->once())
            ->method('convert')
            ->with($report)
            ->willReturn('converted-report');

        $convertedReport = $this->createLoadingTimeBenchmarkHandler->handle($command);

        $this->assertSame('converted-report', $convertedReport);
    }

    private function createReport(): Report
    {
        return new Report('some-report', []);
    }

    private function createAllTimes(): AllTimes
    {
        $allTimes = new AllTimes(
            new LoadingTime(self::BENCHMARK_URL, 1)
        );

        foreach (self::COMPARED_URLS as $COMPARED_URL) {
            $allTimes->addComparedLoadingTime(new LoadingTime($COMPARED_URL, 1));
        }

        return $allTimes;
    }
}