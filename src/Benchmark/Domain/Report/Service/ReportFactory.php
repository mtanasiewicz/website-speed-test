<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\Report\Service;

use App\Benchmark\Domain\LoadingTime\Model\AllTimes;
use App\Benchmark\Domain\Report\Model\Report;

/**
 * Interface ReportFactory
 * @package App\Benchmark\Domain\Report\Service
 */
interface ReportFactory
{
    /**
     * @param AllTimes $allTimes
     * @return Report
     */
    public function create(AllTimes $allTimes): Report;
}