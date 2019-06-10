<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\LoadingTime\Service;

use App\Benchmark\Domain\Exception\UnableToCreateBenchmarkException;
use App\Benchmark\Domain\LoadingTime\Model\AllTimes;
use App\Benchmark\Domain\LoadingTime\Model\LoadingTime;
use Throwable;

/**
 * Class AllTimesFactory
 * @package App\Benchmark\Domain\LoadingTime\Service
 */
class AllTimesFactory
{
    /**
     * @var LoadingTimeFactory
     */
    private $loadingTimeFactory;

    /**
     * AllTimesFactory constructor.
     * @param LoadingTimeFactory $loadingTimeFactory
     */
    public function __construct(LoadingTimeFactory $loadingTimeFactory)
    {
        $this->loadingTimeFactory = $loadingTimeFactory;
    }

    /**
     * @param string $benchmarkUrl
     * @param array $comparedUrls
     * @return AllTimes
     * @throws UnableToCreateBenchmarkException
     */
    public function create(string $benchmarkUrl, array $comparedUrls): AllTimes
    {
        $benchmark = $this->createLoadingTimeForBenchmarkWebsite($benchmarkUrl);
        $allTimes = new AllTimes($benchmark);

        $this->createLoadingTimesForComparedWebsites($comparedUrls, $allTimes);

        return $allTimes;
    }

    /**
     * @param array $comparedUrls
     * @param AllTimes $allTimes
     */
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
     * @param string $benchmarkUrl
     * @return LoadingTime
     * @throws UnableToCreateBenchmarkException
     */
    private function createLoadingTimeForBenchmarkWebsite(string $benchmarkUrl): LoadingTime
    {
        try {
            return $this->loadingTimeFactory->create($benchmarkUrl);
        } catch (Throwable $e) {
            $message = $e->getMessage();

            throw new UnableToCreateBenchmarkException("$message Benchmark impossible.");
        }
    }
}