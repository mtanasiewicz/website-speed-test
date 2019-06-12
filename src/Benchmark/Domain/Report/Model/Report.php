<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\Report\Model;

use DateTime;
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
    /**
     * @var DateTime
     */
    private $createdAt;

    public function __construct(string $name, array $sections)
    {
        Assert::allIsInstanceOf($sections,Section::class);

        $this->sections = $sections;
        $this->name = $name;
        $this->createdAt = new DateTime();
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

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
}