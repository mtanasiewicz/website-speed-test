<?php
declare(strict_types=1);

namespace App\Benchmark\Application;

class CreateLoadingTimeBenchmarkCommand
{
    /** @var string  */
    private $benchmarkUrl;

    /** @var array  */
    private $comparedUrls;

    public function __construct(string $benchmarkUrl, array $comparedUrls)
    {
        $this->benchmarkUrl = $benchmarkUrl;
        $this->comparedUrls = $comparedUrls;
    }

    public function getBenchmarkUrl(): string
    {
        return $this->benchmarkUrl;
    }

    public function getComparedUrls(): array
    {
        return $this->comparedUrls;
    }
}