<?php
declare(strict_types=1);

namespace App\Benchmark\Application;

/**
 * Class CreateLoadingTimeBenchmarkCommand
 * @package App\Benchmark\Application
 */
class CreateLoadingTimeBenchmarkCommand
{
    /**
     * @var string
     */
    private $benchmarkUrl;

    /**
     * @var array
     */
    private $comparedUrls;

    /**
     * CreateLoadingTimeBenchmarkCommand constructor.
     * @param string $benchmarkUrl
     * @param array $comparedUrls
     */
    public function __construct(string $benchmarkUrl, array $comparedUrls)
    {
        $this->benchmarkUrl = $benchmarkUrl;
        $this->comparedUrls = $comparedUrls;
    }

    /**
     * @return string
     */
    public function getBenchmarkUrl(): string
    {
        return $this->benchmarkUrl;
    }

    /**
     * @return array
     */
    public function getComparedUrls(): array
    {
        return $this->comparedUrls;
    }
}