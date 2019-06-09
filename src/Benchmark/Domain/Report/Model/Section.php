<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\Report\Model;

use Webmozart\Assert\Assert;

class Section
{
    /** @var string  */
    private $title;

    /** @var array|Data[] */
    private $data;

    public function __construct(string $title, array $data)
    {
        Assert::allImplementsInterface($data, Data::class);

        $this->title = $title;
        $this->data = $data;
    }

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
}