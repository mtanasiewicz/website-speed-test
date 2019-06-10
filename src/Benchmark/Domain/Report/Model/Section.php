<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\Report\Model;

use Webmozart\Assert\Assert;

/**
 * Class Section
 * @package App\Benchmark\Domain\Report\Model
 */
class Section
{
    /**
     * @var string
     */
    private $title;
    /**
     * @var Data[]
     */
    private $data;

    public function __construct(string $title, array $data)
    {
        Assert::allImplementsInterface($data, Data::class);

        $this->title = $title;
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return Data[]
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return count($this->data) === 0;
    }
}