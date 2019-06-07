<?php
declare(strict_types=1);

namespace App\Log\Domain\Service\ReportToLogConverter;

use App\Benchmark\Domain\Report\Model\Report;
use App\Benchmark\Domain\Report\Model\Section;
use App\Benchmark\Domain\Report\Service\ReportConverter;
use function array_map;

class ReportToLogConverter implements ReportConverter
{
    private const SECTION_SEPARATOR = '';

    /** @var SectionConverter  */
    private $sectionConverter;

    public function __construct(SectionConverter $sectionConverter)
    {
        $this->sectionConverter = $sectionConverter;
    }


    public function convert(Report $report): string
    {
        $texts = array_map(function (Section $section) {
            return $this->sectionConverter->convert($section);
        }, $report->getSections());

        return implode(self::SECTION_SEPARATOR, $texts);
    }
}