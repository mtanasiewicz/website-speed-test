<?php
declare(strict_types=1);

namespace App\Tests\Unit\Benchmark\Domain\Report\Service\SimpleLoadingTimeReport;

use App\Benchmark\Domain\Report\Model\ReportCreationDate;
use App\Benchmark\Domain\Report\Model\Section;
use App\Benchmark\Domain\Report\Service\SimpleLoadingTimeReport\DateSectionFactory;
use App\Tests\Unit\UnitTestBase;
use DateTime;

class DateSectionFactoryTest extends UnitTestBase
{
    /**
     * @var DateSectionFactory
     */
    private $dateSectionFactory;

    public function setUp()
    {
        parent::setUp();
        $this->dateSectionFactory = new DateSectionFactory();
    }

    public function testItCreatesDateSection(): void
    {
        $dateTime = new DateTime();
        $dateSection = $this->dateSectionFactory->create($dateTime);

        $data = $dateSection->getData();

        $this->assertInstanceOf(Section::class, $dateSection);
        $this->assertInstanceOf(ReportCreationDate::class, $data[0]);
        $this->assertSame($dateTime->format('Y-m-d H:i:s'), $data[0]->getValue());
        $this->assertSame('created_at', $data[0]->getName());
        $this->assertSame(DateSectionFactory::SECTION_TITLE, $dateSection->getTitle());
    }
}