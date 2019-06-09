<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\Exception;

use App\Shared\Exception\InfrastructureException;

class CouldNotConnectToUrlException extends InfrastructureException
{
}