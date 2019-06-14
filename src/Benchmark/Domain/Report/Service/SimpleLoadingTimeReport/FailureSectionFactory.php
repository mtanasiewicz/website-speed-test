<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\Report\Service\SimpleLoadingTimeReport;

use App\Benchmark\Domain\LoadingTime\Model\AllTimes;
use App\Benchmark\Domain\Report\Model\Failed;
use App\Benchmark\Domain\Report\Model\Section;

/**
 * Class FailureSectionFactory
 * @package App\Benchmark\Domain\Report\Service\SimpleLoadingTimeReport
 */
class FailureSectionFactory
{
    public const SECTION_TITLE = 'FAILED BENCHMARKS:';

    /**
     * @param AllTimes $allTimes
     * @return Section
     */
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