<?php
declare(strict_types=1);

namespace App\Tests\Unit\Benchmark\Infrastructure\Logger\Conversion\ReportToLogConverter;

use App\Benchmark\Domain\LoadingTime\Model\LoadingTime;
use App\Benchmark\Domain\Report\Model\Report;
use App\Benchmark\Domain\Report\Model\Section;
use App\Benchmark\Infrastructure\Logger\Conversion\ReportToLogConverter\ReportToLogConverter;
use App\Benchmark\Infrastructure\Logger\Conversion\ReportToLogConverter\SectionConverter;
use App\Tests\Unit\UnitTestBase;
use PHPUnit\Framework\MockObject\MockObject;

class ReportToLogConverterTest extends UnitTestBase
{
    const TITLE = 'title';
    const URL = 'url';
    const VALUE = 123;
    const REPORT_NAME = 'report-name';
    /**
     * @var MockObject|SectionConverter
     */
    private $sectionConverter;
    /**
     * @var ReportToLogConverter
     */
    private $reportToLogConverter;

    protected function setUp()
    {
        parent::setUp();

        $this->sectionConverter = $this->createMock(SectionConverter::class);
        $this->reportToLogConverter = new ReportToLogConverter($this->sectionConverter);
    }

    public function testThatItConverts(): void
    {
        $data = new LoadingTime(self::URL, self::VALUE);
        $section = new Section(self::TITLE, [$data]);
        $report = new Report(self::REPORT_NAME, [$section]);

        $this->sectionConverter
            ->expects($this->once())
            ->method('convert')
            ->with($section)
            ->willReturn(self::TITLE.self::URL.(string) self::VALUE);

        $converted = $this->reportToLogConverter->convert($report);

        $this->assertContains(self::TITLE, $converted);
        $this->assertContains(self::URL, $converted);
        $this->assertContains((string) self::VALUE, $converted);
    }
}