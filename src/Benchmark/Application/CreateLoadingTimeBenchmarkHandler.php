<?php
declare(strict_types=1);

namespace App\Benchmark\Application;

use App\Benchmark\Domain\LoadingTime\Service\LoadingTimeFactory;
use App\Shared\Exception\InvalidArgumentException;
use function array_map;

class CreateLoadingTimeBenchmarkHandler
{
    /** @var LoadingTimeFactory  */
    private $loadingTimeFactory;

    public function __construct(LoadingTimeFactory $loadingTimeFactory)
    {
        $this->loadingTimeFactory = $loadingTimeFactory;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function handle(CreateLoadingTimeBenchmarkCommand $command)
    {
        $benchmarkUrl = $command->getBenchmarkUrl();

        $allTimes = $this->createLoadingTimes($command->getComparedUrls(), $benchmarkUrl);


    }

    /**
     * @throws InvalidArgumentException
     */
    private function createLoadingTimes(array $comparedUrls, string $benchmarkUrl): array
    {
        $allTimes = array_map(function (string $url) {
            return $this->loadingTimeFactory->create($url);
        }, $comparedUrls);

        $allTimes[] = $this->loadingTimeFactory->create($benchmarkUrl);

        return $allTimes;
    }
}