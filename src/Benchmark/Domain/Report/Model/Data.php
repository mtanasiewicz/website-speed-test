<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\Report\Model;

/**
 * Interface Data
 * @package App\Benchmark\Domain\Report\Model
 */
interface Data
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return mixed
     */
    public function getValue();
}