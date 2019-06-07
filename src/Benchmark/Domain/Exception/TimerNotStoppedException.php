<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\Exception;

use App\Shared\Exception\InvalidArgumentException;

class TimerNotStoppedException extends InvalidArgumentException
{
}