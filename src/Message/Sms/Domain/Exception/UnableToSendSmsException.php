<?php
declare(strict_types=1);

namespace App\Message\Sms\Domain\Exception;

use App\Shared\Exception\InfrastructureException;

/**
 * Class UnableToSendSmsException
 * @package App\Message\Sms\Domain\Exception
 */
class UnableToSendSmsException extends InfrastructureException
{
}