<?php
declare(strict_types=1);

namespace App\Message\Sms\Domain\Service;

use App\Message\Sms\Domain\Exception\UnableToSendSmsException;
use App\Message\Sms\Domain\Model\Sms;

/**
 * Interface SmsGateway
 * @package App\Message\Sms\Domain\Service
 */
interface SmsGateway
{
    /**
     * @param Sms $sms
     *
     * @throws UnableToSendSmsException
     */
    public function send(Sms $sms): void;
}