<?php
declare(strict_types=1);

namespace App\Benchmark\Application;

use App\Benchmark\Application\Service\Notificator;
use App\Benchmark\Domain\LoadingTime\Service\AllTimesFactory;
use App\Benchmark\Domain\Logger\ReportLogger;
use App\Benchmark\Domain\Report\Service\ReportFactory;
use App\Benchmark\Infrastructure\Logger\Conversion\ReportConverter;
use App\Shared\Exception\InfrastructureException;

/**
 * Class CreateLoadingTimeBenchmarkHandler
 * @package App\Benchmark\Application
 */
class CreateLoadingTimeBenchmarkHandler
{
    /**
     * @var AllTimesFactory
     */
    private $allTimesFactory;
    /**
     * @var ReportFactory
     */
    private $reportFactory;
    /**
     * @var ReportConverter
     */
    private $reportConverter;
    /**
     * @var Notificator
     */
    private $notificator;
    /**
     * @var ReportLogger
     */
    private $reportLogger;

    /**
     * CreateLoadingTimeBenchmarkHandler constructor.
     * @param AllTimesFactory $allTimesFactory
     * @param ReportFactory $reportFactory
     * @param ReportConverter $jsonConverter
     * @param Notificator $notificator
     * @param ReportLogger $reportLogger
     */
    public function __construct(
        AllTimesFactory $allTimesFactory,
        ReportFactory $reportFactory,
        ReportConverter $jsonConverter,
        Notificator $notificator,
        ReportLogger $reportLogger
    )
    {
        $this->allTimesFactory = $allTimesFactory;
        $this->reportFactory = $reportFactory;
        $this->reportConverter = $jsonConverter;
        $this->notificator = $notificator;
        $this->reportLogger = $reportLogger;
    }

    /**
     * @param CreateLoadingTimeBenchmarkCommand $command
     * @return string
     * @throws InfrastructureException
     */
    public function handle(CreateLoadingTimeBenchmarkCommand $command): string
    {
        $benchmarkUrl = $command->getBenchmarkUrl();

        $allTimes = $this->allTimesFactory->create($benchmarkUrl, $command->getComparedUrls());
        $this->notificator->notifyAboutFasterWebsites($command->getEmail(), $command->getPhoneNumber(), $allTimes);

        $report = $this->reportFactory->create($allTimes);

        $this->reportLogger->log($report);

        return $this->reportConverter->convert($report);
    }
}