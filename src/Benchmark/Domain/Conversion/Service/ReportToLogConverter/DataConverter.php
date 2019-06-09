<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\Conversion\Service\ReportToLogConverter;

use App\Benchmark\Domain\Report\Model\Data;

class DataConverter
{
    public function covert(Data $data): string
    {
        return $data->getName() . ': ' . $data->getValue();
    }
}