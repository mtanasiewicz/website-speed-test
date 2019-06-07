<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\Log\Service\ReportToLogConverter;

use App\Benchmark\Domain\Log\Service\ReportConverter;
use App\Benchmark\Domain\Report\Model\Report;
use App\Benchmark\Domain\Report\Model\Section;
use function array_walk;

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
        $sections = $report->getSections();

        $reportText = '';

        array_walk($sections, function (Section $section) use (&$reportText) {
            $reportText .= $this->sectionConverter->convert($section);

            $reportText .= self::SECTION_SEPARATOR;
        });

        return $reportText;
    }
}