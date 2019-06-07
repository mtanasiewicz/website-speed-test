<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\Report\Service\SimpleLoadingTimeBenchmark;

use App\Benchmark\Domain\LoadingTime\Model\AllTimes;
use App\Benchmark\Domain\Report\Model\Section;

class InfoSectionFactory
{
    private const SECTION_TITLE = 'Benchmark websites times: ';

    public function create(AllTimes $allTimes): Section
    {
        return new Section(self::SECTION_TITLE, [$allTimes->getAllTimes()]);
    }
}