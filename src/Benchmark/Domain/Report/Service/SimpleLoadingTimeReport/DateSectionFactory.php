<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\Report\Service\SimpleLoadingTimeReport;

use App\Benchmark\Domain\Report\Model\ReportCreationDate;
use App\Benchmark\Domain\Report\Model\Section;
use DateTime;

class DateSectionFactory
{
    private const SECTION_TITLE = 'Report creation date';

    public function create(DateTime $createdAt): Section
    {
        $data = new ReportCreationDate($createdAt);

        return new Section(self::SECTION_TITLE, [$data]);
    }
}