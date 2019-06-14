<?php
declare(strict_types=1);

namespace App\Tests\Unit\Benchmark\Infrastructure\Logger\Conversion\ReportToLogConverter;

use App\Benchmark\Domain\LoadingTime\Model\LoadingTime;
use App\Benchmark\Infrastructure\Logger\Conversion\ReportToLogConverter\DataConverter;
use App\Tests\Unit\UnitTestBase;

class DataConverterTest extends UnitTestBase
{
    const URL = 'url';
    const VALUE = 123;

    public function testThatItConverts(): void
    {
        $data = new LoadingTime(self::URL, self::VALUE);

        $result = (new DataConverter())->covert($data);

        $this->assertSame(self::URL . ': ' . self::VALUE, $result);
    }
}