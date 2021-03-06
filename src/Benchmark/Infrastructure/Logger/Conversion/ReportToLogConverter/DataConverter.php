<?php
declare(strict_types=1);

namespace App\Benchmark\Infrastructure\Logger\Conversion\ReportToLogConverter;

use App\Benchmark\Domain\Report\Model\Data;

/**
 * Class DataConverter
 * @package App\Benchmark\Domain\Conversion\Service\ReportToLogConverter
 */
class DataConverter
{
    /**
     * @param Data $data
     * @return string
     */
    public function convert(Data $data): string
    {
        return $data->getName() . ': ' . $data->getValue();
    }
}