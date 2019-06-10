<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\Conversion\Service;

use App\Benchmark\Domain\Report\Model\Report;

/**
 * Interface ReportConverter
 * @package App\Benchmark\Domain\Conversion\Service
 */
interface ReportConverter
{
    /**
     * @param Report $report
     * @return mixed
     */
    public function convert(Report $report);
}