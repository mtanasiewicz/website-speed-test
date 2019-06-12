<?php
declare(strict_types=1);

namespace App\Benchmark\Infrastructure\Logger\Conversion\ReportToJsonConverter;

use App\Benchmark\Domain\Report\Model\Section;

/**
 * Class SectionConverter
 * @package App\Benchmark\Domain\Conversion\Service\ReportToJsonConverter
 */
class SectionConverter
{
    /**
     * @param Section $section
     * @return array
     */
    public function convert(Section $section): array
    {
        $data = [
            $section->getTitle() => [$section->getData()],
        ];

        return $data;
    }
}