<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\Logger;

use App\Benchmark\Domain\Report\Model\Report;

interface ReportLogger
{
    public function log(Report $report): void;
}