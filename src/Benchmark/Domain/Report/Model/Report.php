<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\Report\Model;

use Webmozart\Assert\Assert;

class Report
{
    /** @var string  */
    private $name;

    /** @var array|Section[] */
    private $sections;

    public function __construct(string $name, array $sections)
    {
        Assert::allIsInstanceOf($sections,Section::class);

        $this->sections = $sections;
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Section[]
     */
    public function getSections(): array
    {
        return $this->sections;
    }
}