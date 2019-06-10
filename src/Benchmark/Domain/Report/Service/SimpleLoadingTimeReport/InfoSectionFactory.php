<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\Report\Service\SimpleLoadingTimeReport;

use App\Benchmark\Domain\LoadingTime\Model\AllTimes;
use App\Benchmark\Domain\Report\Model\Section;

/**
 * Class InfoSectionFactory
 * @package App\Benchmark\Domain\Report\Service\SimpleLoadingTimeReport
 */
class InfoSectionFactory
{
    private const SECTION_TITLE = 'Benchmark websites times in milliseconds: ';

    /**
     * @param AllTimes $allTimes
     * @return Section
     */
    public function create(AllTimes $allTimes): Section
    {
        return new Section(self::SECTION_TITLE, $allTimes->getAllTimes());
    }
}