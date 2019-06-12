<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\Report\Model;

use DateTime;

class ReportCreationDate implements Data
{
    /**
     * @var DateTime
     */
    private $createdAt;

    public function __construct(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getName(): string
    {
        return 'created_at';
    }

    public function getValue()
    {
        return $this->createdAt->format('Y-m-d H:i:s');
    }
}