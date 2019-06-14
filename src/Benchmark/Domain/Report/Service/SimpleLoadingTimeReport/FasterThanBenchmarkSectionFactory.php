<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\Report\Service\SimpleLoadingTimeReport;

use App\Benchmark\Domain\LoadingTime\Model\AllTimes;
use App\Benchmark\Domain\LoadingTime\Model\LoadingTime;
use App\Benchmark\Domain\Report\Model\Section;
use function array_filter;

/**
 * Class FasterThanBenchmarkSectionFactory
 * @package App\Benchmark\Domain\Report\Service\SimpleLoadingTimeReport
 */
class FasterThanBenchmarkSectionFactory
{
    public const SECTION_TITLE = 'Websites that have been faster than the benchmark website: ';

    /**
     * @param AllTimes $allTimes
     * @return Section
     */
    public function create(AllTimes $allTimes): Section
    {
        $benchmarkTime = $allTimes->getBenchmarkTime();

        $fasterTimes = array_filter(
            $allTimes->getComparedTimes(),
            function (LoadingTime $comparedTime) use ($benchmarkTime) {

            return $comparedTime->getValue() < $benchmarkTime->getValue();
        });

        return new Section(self::SECTION_TITLE, $fasterTimes);
    }
}