<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\Log\Service\ReportToLogConverter;

use App\Benchmark\Domain\Report\Model\Data;
use App\Benchmark\Domain\Report\Model\Section;
use function array_walk;

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
        $sectionText = '';

        array_walk($section->getData(), function (Data $data) use (&$sectionText) {
            $sectionText .= $this->dataConverter->covert($data);
            $sectionText .= self::DATA_SEPARATOR;
        });

        return $sectionText;
    }
}