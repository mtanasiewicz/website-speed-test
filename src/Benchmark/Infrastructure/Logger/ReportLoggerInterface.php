<?php
declare(strict_types=1);

namespace App\Benchmark\Infrastructure\Logger;

use App\Benchmark\Domain\Report\Model\Report;

interface ReportLoggerInterface
{
    public function log(Report $report): void;
}