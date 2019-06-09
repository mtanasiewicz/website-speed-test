<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\LoadingTime\Service;

use App\Benchmark\Domain\Exception\UnableToCreateBenchmarkException;
use App\Benchmark\Domain\LoadingTime\Model\AllTimes;
use Throwable;

class AllTimesFactory
{
    /** @var LoadingTimeFactory  */
    private $loadingTimeFactory;

    public function __construct(LoadingTimeFactory $loadingTimeFactory)
    {
        $this->loadingTimeFactory = $loadingTimeFactory;
    }

    /**
     * @throws UnableToCreateBenchmarkException
     */
    public function create(string $benchmarkUrl, array $comparedUrls): AllTimes
    {
        $allTimes = new AllTimes();

        $this->createLoadingTimeForBenchmarkWebsite($benchmarkUrl, $allTimes);
        $this->createLoadingTimesForComparedWebsites($comparedUrls, $allTimes);

        return $allTimes;
    }

    private function createLoadingTimesForComparedWebsites(array $comparedUrls, AllTimes $allTimes): void
    {
        foreach ($comparedUrls as $url) {
            try {
                $loadingTime = $this->loadingTimeFactory->create($url);

                $allTimes->addComparedLoadingTime($loadingTime);
            } catch (Throwable $e) {
                $allTimes->addFailure($url, $e->getMessage());

                continue;
            }
        }
    }

    /**
     * @throws UnableToCreateBenchmarkException
     */
    private function createLoadingTimeForBenchmarkWebsite(string $benchmarkUrl, AllTimes $allTimes): void
    {
        try {
            $benchmarkTime = $this->loadingTimeFactory->create($benchmarkUrl);

            $allTimes->setBenchmarkTime($benchmarkTime);
        } catch (Throwable $e) {
            $message = $e->getMessage();

            throw new UnableToCreateBenchmarkException("$message Benchmark impossible.");
        }
    }
}