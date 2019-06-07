<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\Report\Service;

use App\Benchmark\Domain\Report\Model\Report;

interface ReportConverter
{
    public function convert(Report $report);
}