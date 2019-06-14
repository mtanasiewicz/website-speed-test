<?php
declare(strict_types=1);

namespace App\Tests\Unit\Benchmark\Infrastructure\Logger\Conversion\ReportToJsonConverter;

use App\Benchmark\Domain\Report\Model\Report;
use App\Benchmark\Domain\Report\Model\Section;
use App\Benchmark\Infrastructure\Logger\Conversion\ReportToJsonConverter\ReportToJsonConverter;
use App\Benchmark\Infrastructure\Logger\Conversion\ReportToJsonConverter\SectionConverter;
use App\Shared\Infrastructure\Serializer\Serializer;
use App\Tests\Unit\UnitTestBase;
use PHPUnit\Framework\MockObject\MockObject;

class ReportToJsonConverterTest extends UnitTestBase
{
    const NAME = 'report';
    const TITLE = 'title';
    /**
     * @var MockObject|SectionConverter
     */
    private $sectionConverter;
    /**
     * @var MockObject|Serializer
     */
    private $serializer;
    /**
     * @var ReportToJsonConverter
     */
    private $reportToJsonConverter;

    protected function setUp()
    {
        parent::setUp();

        $this->sectionConverter = $this->createMock(SectionConverter::class);
        $this->serializer = $this->createMock(Serializer::class);
        $this->reportToJsonConverter = new ReportToJsonConverter($this->sectionConverter, $this->serializer);
    }

    public function testThatItConverts(): void
    {
        $section = new Section(self::TITLE, []);
        $report = new Report(self::NAME, [$section]);

        $returnMock = ['apple'];
        $this->sectionConverter
            ->expects($this->once())
            ->method('convert')
            ->with($section)
            ->willReturn($returnMock);

        $encodedMock = json_encode($returnMock);
        $this->serializer
            ->expects($this->once())
            ->method('serialize')
            ->with([$returnMock])
            ->willReturn($encodedMock);

        $converted = $this->reportToJsonConverter->convert($report);

        $this->assertSame($encodedMock, $converted);
    }
}