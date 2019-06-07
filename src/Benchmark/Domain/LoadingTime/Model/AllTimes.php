<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\LoadingTime\Model;

use function array_unshift;

class AllTimes
{
    /**
     * @var LoadingTime|null
     */
    private $benchmarkTime = null;

    /**
     * @var LoadingTime[]
     */
    private $comparedTimes;

    public function getBenchmarkTime(): LoadingTime
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