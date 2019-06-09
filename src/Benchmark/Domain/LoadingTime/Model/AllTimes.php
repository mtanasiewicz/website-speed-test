<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\LoadingTime\Model;

use function array_unshift;

class AllTimes
{
    /** @var null|LoadingTime */
    private $benchmarkTime = null;

    /** @var null|LoadingTime[] */
    private $comparedTimes = [];

    /** @var array  */
    private $failures = [];

    public function getBenchmarkTime(): ?LoadingTime
    {
        return $this->benchmarkTime;
    }

    public function addComparedLoadingTime(LoadingTime $loadingTime): self
    {
        $this->comparedTimes[$loadingTime->getName()] = $loadingTime;

        return $this;
    }

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

    public function addFailure(string $url, string  $message): void
    {
        $this->failures[$url] = $message;
    }

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