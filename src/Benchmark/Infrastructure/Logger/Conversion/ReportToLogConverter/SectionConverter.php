<?php
declare(strict_types=1);

namespace App\Benchmark\Infrastructure\Logger\Conversion\ReportToLogConverter;

use App\Benchmark\Domain\Report\Model\Data;
use App\Benchmark\Domain\Report\Model\Section;
use function array_map;

/**
 * Class SectionConverter
 * @package App\Benchmark\Domain\Conversion\Service\ReportToLogConverter
 */
class SectionConverter
{
    private const DATA_SEPARATOR = "\r\n";

    /**
     * @var DataConverter
     */
    private $dataConverter;

    /**
     * SectionConverter constructor.
     * @param DataConverter $dataConverter
     */
    public function __construct(DataConverter $dataConverter)
    {
        $this->dataConverter = $dataConverter;
    }

    /**
     * @param Section $section
     * @return string
     */
    public function convert(Section $section): string
    {
        $texts = array_map(function (Data $data) {
            return $this->dataConverter->convert($data);
        }, $section->getData());

        array_unshift($texts, $section->getTitle());

        $endSectionSeparator = self::DATA_SEPARATOR . self::DATA_SEPARATOR;

        return implode(self::DATA_SEPARATOR, $texts) . $endSectionSeparator;
    }
}