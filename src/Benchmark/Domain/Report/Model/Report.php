<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\Report\Model;

use Webmozart\Assert\Assert;

class Report
{
    /** @var array|Section[] */
    private $sections;

    public function __construct(array $sections)
    {
        Assert::allIsInstanceOf($sections,Section::class);

        $this->sections = $sections;
    }

    /**
     * @return Section[]
     */
    public function getSections(): array
    {
        return $this->sections;
    }
}