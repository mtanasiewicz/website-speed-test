<?php
declare(strict_types=1);

namespace App\Benchmark\Infrastructure\Logger\Conversion\ReportToLogConverter;

use App\Benchmark\Domain\Report\Model\Report;
use App\Benchmark\Domain\Report\Model\Section;
use App\Benchmark\Infrastructure\Logger\Conversion\ReportConverter;
use function array_map;

/**
 * Class ReportToLogConverter
 * @package App\Benchmark\Domain\Conversion\Service\ReportToLogConverter
 */
class ReportToLogConverter implements ReportConverter
{
    private const SECTION_SEPARATOR = '';

    /**
     * @var SectionConverter
     */
    private $sectionConverter;

    /**
     * ReportToLogConverter constructor.
     * @param SectionConverter $sectionConverter
     */
    public function __construct(SectionConverter $sectionConverter)
    {
        $this->sectionConverter = $sectionConverter;
    }

    /**
     * @param Report $report
     * @return string
     */
    public function convert(Report $report): string
    {
        $texts = array_map(function (Section $section) {
            return $this->sectionConverter->convert($section);
        }, $report->getSections());

        return implode(self::SECTION_SEPARATOR, $texts);
    }
}