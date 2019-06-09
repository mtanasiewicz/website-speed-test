<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\Report\Model;

interface Data
{
    public function getName(): string;

    public function getValue();
}