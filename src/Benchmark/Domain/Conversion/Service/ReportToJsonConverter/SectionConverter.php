<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\Conversion\Service\ReportToJsonConverter;

use App\Benchmark\Domain\Report\Model\Section;

class SectionConverter
{

    public function convert(Section $section): array
    {
        $data = [
            $section->getTitle() => [$section->getData()],
        ];

        return $data;
    }
}