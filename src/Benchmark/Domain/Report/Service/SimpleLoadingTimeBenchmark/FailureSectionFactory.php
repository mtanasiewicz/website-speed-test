<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\Report\Service\SimpleLoadingTimeBenchmark;

use App\Benchmark\Domain\LoadingTime\Model\AllTimes;
use App\Benchmark\Domain\Report\Model\Failed;
use App\Benchmark\Domain\Report\Model\Section;

class FailureSectionFactory
{
    private const SECTION_TITLE = 'FAILED BENCHMARKS:';

    public function create(AllTimes $allTimes): Section
    {
        $failed = $allTimes->getFailures();

        $data = [];
        foreach ($failed as $key => $value) {
            $data[] = new Failed($key, $value);
        }

        return new Section(self::SECTION_TITLE, $data);
    }
}