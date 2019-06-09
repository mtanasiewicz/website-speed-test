<?php
declare(strict_types=1);

namespace App\Benchmark\Application;

use App\Benchmark\Domain\Conversion\Service\ReportConverter;
use App\Benchmark\Domain\LoadingTime\Service\AllTimesFactory;
use App\Benchmark\Domain\Report\Service\ReportFactory;
use App\Shared\Exception\InfrastructureException;
use App\Shared\Exception\InvalidArgumentException;

class CreateLoadingTimeBenchmarkHandler
{
    /** @var AllTimesFactory */
    private $allTimesFactory;

    /** @var ReportFactory */
    private $reportFactory;

    /** @var ReportConverter  */
    private $reportConverter;

    public function __construct(
        AllTimesFactory $allTimesFactory,
        ReportFactory $reportFactory,
        ReportConverter $jsonConverter
    )
    {
        $this->allTimesFactory = $allTimesFactory;
        $this->reportFactory = $reportFactory;
        $this->reportConverter = $jsonConverter;
    }

    /**
     * @throws InvalidArgumentException
     * @throws InfrastructureException
     */
    public function handle(CreateLoadingTimeBenchmarkCommand $command): string
    {
        $benchmarkUrl = $command->getBenchmarkUrl();

        $allTimes = $this->allTimesFactory->create($benchmarkUrl, $command->getComparedUrls());

        $report = $this->reportFactory->create($allTimes);

        return $this->reportConverter->convert($report);
    }
}