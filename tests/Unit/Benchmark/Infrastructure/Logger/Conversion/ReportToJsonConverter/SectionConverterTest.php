<?php
declare(strict_types=1);

namespace App\Tests\Unit\Benchmark\Infrastructure\Logger\Conversion\ReportToJsonConverter;

use App\Benchmark\Domain\LoadingTime\Model\LoadingTime;
use App\Benchmark\Domain\Report\Model\Data;
use App\Benchmark\Domain\Report\Model\Section;
use App\Benchmark\Infrastructure\Logger\Conversion\ReportToJsonConverter\SectionConverter;
use App\Tests\Unit\UnitTestBase;

class SectionConverterTest extends UnitTestBase
{
    const TITLE = 'title';
    const URL = 'url';
    const VALUE = 1;

    public function testThatItConverts(): void
    {
        $sectionConverter = new SectionConverter();

        $section = new Section(self::TITLE, [new LoadingTime(self::URL, self::VALUE)]);

        $converted = $sectionConverter->convert($section);

        $this->assertInternalType('array', $converted);
        $this->assertSame(self::TITLE, array_keys($converted)[0]);
        $this->assertInternalType('array', $converted[self::TITLE]);
        foreach ($converted[self::TITLE] as $item) {
            $this->assertInstanceOf(Data::class, $item);
        }
    }
}