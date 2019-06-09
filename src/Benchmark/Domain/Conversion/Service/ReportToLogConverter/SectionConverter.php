<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\Conversion\Service\ReportToLogConverter;

use App\Benchmark\Domain\Report\Model\Data;
use App\Benchmark\Domain\Report\Model\Section;
use function array_map;

class SectionConverter
{
    private const DATA_SEPARATOR = "\r\n";

    /** @var DataConverter  */
    private $dataConverter;

    public function __construct(DataConverter $dataConverter)
    {
        $this->dataConverter = $dataConverter;
    }

    public function convert(Section $section): string
    {
        $texts = array_map(function (Data $data) {
            return $this->dataConverter->covert($data);
        }, $section->getData());

        array_unshift($texts, $section->getTitle());

        $endSectionSeparator = self::DATA_SEPARATOR . self::DATA_SEPARATOR;

        return implode(self::DATA_SEPARATOR, $texts) . $endSectionSeparator;
    }
}