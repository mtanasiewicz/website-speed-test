<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\Report\Model;

use Webmozart\Assert\Assert;

/**
 * Class Report
 * @package App\Benchmark\Domain\Report\Model
 */
class Report
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var Section[]
     */
    private $sections;

    public function __construct(string $name, array $sections)
    {
        Assert::allIsInstanceOf($sections,Section::class);

        $this->sections = $sections;
        $this->name = $name;
    }

    /**
     * @return string
     */
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

    /**
     * @param Section $section
     */
    public function addSection(Section $section): void
    {
        $this->sections[] = $section;
    }
}