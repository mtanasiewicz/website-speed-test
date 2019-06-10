<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\LoadingTime\Model;

use function array_filter;
use function array_unshift;

/**
 * Class AllTimes
 * @package App\Benchmark\Domain\LoadingTime\Model
 */
class AllTimes
{
    /**
     * @var LoadingTime
     */
    private $benchmarkTime;
    /**
     * @var LoadingTime[]
     */
    private $comparedTimes = [];
    /**
     * @var array
     */
    private $failures = [];

    /**
     * AllTimes constructor.
     * @param LoadingTime $benchmarkTime
     */
    public function __construct(LoadingTime $benchmarkTime)
    {
        $this->benchmarkTime = $benchmarkTime;
    }

    /**
     * @return LoadingTime
     */
    public function getBenchmarkTime(): LoadingTime
    {
        return $this->benchmarkTime;
    }

    /**
     * @param LoadingTime $loadingTime
     * @return AllTimes
     */
    public function addComparedLoadingTime(LoadingTime $loadingTime): self
    {
        $this->comparedTimes[] = $loadingTime;

        return $this;
    }

    /**
     * @return LoadingTime[]
     */
    public function getComparedTimes(): array
    {
        return $this->comparedTimes;
    }

    /**
     * @param string $url
     * @param string $message
     */
    public function addFailure(string $url, string  $message): void
    {
        $this->failures[$url] = $message;
    }

    /**
     * @return array
     */
    public function getFailures(): array
    {
        return $this->failures;
    }

    /**
     * @return LoadingTime[]
     */
    public function getAllTimes(): array
    {
        $allTimes = $this->getComparedTimes();

        array_unshift($allTimes, $this->getBenchmarkTime());

        return $allTimes;
    }

    /**
     * @return LoadingTime[]
     */
    public function getTimesFasterThanBenchmark(): array
    {
        return array_filter($this->comparedTimes, function (LoadingTime $comparedTime) {
            return $this->benchmarkTime->getValue() > $comparedTime->getValue();
        });
    }

    /**
     * @return LoadingTime[]
     */
    public function getTimesTwoTimesFasterThanBenchmark(): array
    {
        return array_filter($this->comparedTimes, function (LoadingTime $comparedTime) {
            return $this->benchmarkTime->getValue() > ($comparedTime->getValue() / 2);
        });
    }
}