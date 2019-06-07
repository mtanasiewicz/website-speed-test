<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\LoadingTime\Model;

use App\Benchmark\Domain\Report\Model\Data;

class LoadingTime implements Data
{
    /** @var string  */
    private $name;

    /** @var float  */
    private $value;

    public function __construct(string $url, float $value)
    {
        $this->name = $url;
        $this->value = $value;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue(): float
    {
        return $this->value;
    }
}