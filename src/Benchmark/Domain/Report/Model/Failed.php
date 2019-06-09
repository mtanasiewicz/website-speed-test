<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\Report\Model;

class Failed implements Data
{
    /** @var string  */
    private $name;

    /** @var string  */
    private $value;

    public function __construct(string $name, string $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}