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
    private $email;
    /**
     * @var string
     */
    private $phoneNumber;
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
    public function __construct(string $email, string $phoneNumber, string $benchmarkUrl, array $comparedUrls)
    {
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->benchmarkUrl = $benchmarkUrl;
        $this->comparedUrls = $comparedUrls;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
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