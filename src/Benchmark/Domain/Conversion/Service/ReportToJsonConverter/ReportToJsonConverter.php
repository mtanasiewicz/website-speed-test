<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\Conversion\Service\ReportToJsonConverter;

use App\Benchmark\Domain\Conversion\Service\ReportConverter;
use App\Benchmark\Domain\Report\Model\Report;
use App\Benchmark\Domain\Report\Model\Section;

class ReportToJsonConverter implements ReportConverter
{
    /** @var SectionConverter  */
    private $sectionConverter;

    public function __construct(SectionConverter $sectionConverter)
    {
        $this->sectionConverter = $sectionConverter;
    }

    public function convert(Report $report): string
    {
        $data = array_map(function (Section $section) {
            return $this->sectionConverter->convert($section);
        }, $report->getSections());

        return json_encode($data);
    }

}