<?php
declare(strict_types=1);

namespace App\Message\Email\Application;

use App\Message\Email\Domain\Service\EmailSender\EmailFactory;
use App\Message\Email\Domain\Service\EmailSender\EmailSender;
use App\Shared\Exception\InfrastructureException;

class SendEmailHandler
{
    /** @var EmailSender  */
    private $emailSender;

    /** @var EmailFactory  */
    private $emailFactory;

    /** @var string  */
    private $sender;

    public function __construct(EmailSender $emailSender, EmailFactory $emailFactory, string $sender)
    {
        $this->emailSender = $emailSender;
        $this->emailFactory = $emailFactory;
        $this->sender = $sender;
    }

    /**
     * @throws InfrastructureException
     */
    public function handle(SendEmailCommand $command): void
    {
        $email = $this->emailFactory->create(
            $command->getRecipient(),
            $this->sender,
            $command->getSubject(),
            $command->getBody()
        );

        $this->emailSender->send($email);
    }
}