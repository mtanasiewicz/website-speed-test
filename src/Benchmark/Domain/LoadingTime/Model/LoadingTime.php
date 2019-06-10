<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\LoadingTime\Model;

use App\Benchmark\Domain\Report\Model\Data;

/**
 * Class LoadingTime
 * @package App\Benchmark\Domain\LoadingTime\Model
 */
class LoadingTime implements Data
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var float
     */
    private $value;

    /**
     * LoadingTime constructor.
     * @param string $url
     * @param float $value
     */
    public function __construct(string $url, float $value)
    {
        $this->name = $url;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }
}