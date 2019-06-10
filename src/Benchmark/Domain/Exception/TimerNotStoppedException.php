<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\Exception;

use App\Shared\Exception\InvalidArgumentException;

/**
 * Class TimerNotStoppedException
 * @package App\Benchmark\Domain\Exception
 */
class TimerNotStoppedException extends InvalidArgumentException
{
}