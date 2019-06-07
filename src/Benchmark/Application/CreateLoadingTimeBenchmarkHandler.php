<?php
declare(strict_types=1);

namespace App\Benchmark\Application;

use App\Benchmark\Domain\LoadingTime\Service\AllTimesFactory;
use App\Shared\Exception\InvalidArgumentException;

class CreateLoadingTimeBenchmarkHandler
{
    /** @var AllTimesFactory  */
    private $allTimesFactory;

    public function __construct(AllTimesFactory $allTimesFactory)
    {
        $this->allTimesFactory = $allTimesFactory;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function handle(CreateLoadingTimeBenchmarkCommand $command)
    {
        $benchmarkUrl = $command->getBenchmarkUrl();

        $allTimes = $this->allTimesFactory->create($benchmarkUrl, $command->getComparedUrls());


    }
}