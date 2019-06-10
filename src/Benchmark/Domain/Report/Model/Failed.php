<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\Report\Model;

/**
 * Class Failed
 * @package App\Benchmark\Domain\Report\Model
 */
class Failed implements Data
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $value;

    /**
     * Failed constructor.
     * @param string $name
     * @param string $value
     */
    public function __construct(string $name, string $value)
    {
        $this->name = $name;
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
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}