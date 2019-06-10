<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\LoadingTime\Model;

use function array_unshift;

/**
 * Class AllTimes
 * @package App\Benchmark\Domain\LoadingTime\Model
 */
class AllTimes
{
    /**
     * @var null
     */
    private $benchmarkTime = null;
    /**
     * @var array
     */
    private $comparedTimes = [];
    /**
     * @var array
     */
    private $failures = [];

    /**
     * @return LoadingTime|null
     */
    public function getBenchmarkTime(): ?LoadingTime
    {
        return $this->benchmarkTime;
    }

    /**
     * @param LoadingTime $loadingTime
     * @return AllTimes
     */
    public function addComparedLoadingTime(LoadingTime $loadingTime): self
    {
        $this->comparedTimes[$loadingTime->getName()] = $loadingTime;

        return $this;
    }

    /**
     * @param LoadingTime $loadingTime
     * @return AllTimes
     */
    public function setBenchmarkTime(LoadingTime $loadingTime): self
    {
        $this->benchmarkTime = $loadingTime;

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
}