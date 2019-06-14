<?php
declare(strict_types=1);

namespace App\Tests\Unit\Benchmark\Infrastructure\Logger\Conversion\ReportToLogConverter;

use App\Benchmark\Domain\LoadingTime\Model\LoadingTime;
use App\Benchmark\Domain\Report\Model\Section;
use App\Benchmark\Infrastructure\Logger\Conversion\ReportToLogConverter\DataConverter;
use App\Benchmark\Infrastructure\Logger\Conversion\ReportToLogConverter\SectionConverter;
use App\Tests\Unit\UnitTestBase;
use PHPUnit\Framework\MockObject\MockObject;

class SectionConverterTest extends UnitTestBase
{
    const VALUE = 123;
    const TITLE = 'title';
    /**
     * @var MockObject|DataConverter
     */
    private $dataConverter;

    protected function setUp()
    {
        parent::setUp();

        $this->dataConverter = $this->createMock(DataConverter::class);
    }

    public function testThatItConverts(): void
    {
        $data = new LoadingTime('url', self::VALUE);
        $section = new Section(self::TITLE, [$data]);

        $this->dataConverter
            ->expects($this->once())
            ->method('convert')
            ->with($data)
            ->willReturn(self::VALUE);

        $converted = (new SectionConverter($this->dataConverter))->convert($section);

        $this->assertContains((string) self::VALUE, $converted);
        $this->assertContains(self::TITLE, $converted);
    }
}