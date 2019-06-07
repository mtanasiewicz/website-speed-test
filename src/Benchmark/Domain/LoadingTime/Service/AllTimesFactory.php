<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\LoadingTime\Service;

use App\Benchmark\Domain\LoadingTime\Model\AllTimes;

class AllTimesFactory
{
    /** @var LoadingTimeFactory  */
    private $loadingTimeFactory;

    public function __construct(LoadingTimeFactory $loadingTimeFactory)
    {
        $this->loadingTimeFactory = $loadingTimeFactory;
    }

    public function create(string $benchmarkUrl, array $comparedUrls): AllTimes
    {
        $allTimes = new AllTimes();
        $benchmarkTime = $this->loadingTimeFactory->create($benchmarkUrl);
        $allTimes->setBenchmarkTime($benchmarkTime);

        foreach ($comparedUrls as $url) {
            $loadingTime = $this->loadingTimeFactory->create($url);

            $allTimes->addComparedLoadingTime($loadingTime);
        }

        return $allTimes;
    }
}