<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\Conversion\Service\ReportToJsonConverter;

use App\Benchmark\Domain\Conversion\Service\ReportConverter;
use App\Benchmark\Domain\Report\Model\Report;
use App\Benchmark\Domain\Report\Model\Section;
use App\Shared\Infrastructure\Serializer\Serializer;

/**
 * Class ReportToJsonConverter
 * @package App\Benchmark\Domain\Conversion\Service\ReportToJsonConverter
 */
class ReportToJsonConverter implements ReportConverter
{
    /**
     * @var SectionConverter
     */
    private $sectionConverter;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * ReportToJsonConverter constructor.
     * @param SectionConverter $sectionConverter
     * @param Serializer $serializer
     */
    public function __construct(SectionConverter $sectionConverter, Serializer $serializer)
    {
        $this->sectionConverter = $sectionConverter;
        $this->serializer = $serializer;
    }

    /**
     * @param Report $report
     * @return string
     */
    public function convert(Report $report): string
    {
        $data = array_map(function (Section $section) {
            return $this->sectionConverter->convert($section);
        }, $report->getSections());

        return $this->serializer->serialize($data);
    }
}