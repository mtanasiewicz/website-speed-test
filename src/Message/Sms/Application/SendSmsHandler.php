<?php
declare(strict_types=1);

namespace App\Message\Sms\Application;

use App\Message\Sms\Domain\Exception\UnableToSendSmsException;
use App\Message\Sms\Domain\Model\Sms;
use App\Message\Sms\Domain\Service\SmsGateway;

/**
 * Class SendSmsHandler
 * @package App\Message\Sms\Application
 */
class SendSmsHandler
{
    /**
     * @var SmsGateway
     */
    private $smsGateway;

    public function __construct(SmsGateway $smsGateway)
    {
        $this->smsGateway = $smsGateway;
    }

    /**
     * @param SendSmsCommand $command
     * @throws UnableToSendSmsException
     */
    public function handle(SendSmsCommand $command): void
    {
        $this->smsGateway->send(new Sms($command->getMessage(), $command->getPhoneNumber()));
    }
}