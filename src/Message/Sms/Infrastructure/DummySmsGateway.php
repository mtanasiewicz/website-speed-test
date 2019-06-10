<?php
declare(strict_types=1);

namespace App\Message\Sms\Infrastructure;

use App\Message\Sms\Domain\Model\Sms;
use App\Message\Sms\Domain\Service\SmsGateway;

/**
 * Class DummySmsGateway - pretends that sends sms.
 * @package App\Message\Sms\Infrastructure
 */
class DummySmsGateway implements SmsGateway
{
    /**
     * @param Sms $sms
     */
    public function send(Sms $sms): void
    {
        return;
    }
}