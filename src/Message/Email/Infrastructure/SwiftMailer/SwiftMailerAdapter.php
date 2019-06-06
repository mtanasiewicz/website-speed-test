<?php
declare(strict_types=1);

namespace App\Message\Email\Infrastructure\SwiftMailer;

use App\Message\Email\Domain\Model\Email;
use App\Message\Email\Domain\Service\EmailSender\MailerAdapter;
use App\Message\Email\Infrastructure\Exception\SendEmailException;
use Swift_Mailer;
use Throwable;

class SwiftMailerAdapter implements MailerAdapter
{
    /** @var MessageFactory  */
    private $messageFactory;

    /** @var Swift_Mailer  */
    private $mailer;

    public function __construct(MessageFactory $messageFactory, Swift_Mailer $mailer)
    {
        $this->messageFactory = $messageFactory;
        $this->mailer = $mailer;
    }

    /**
     * @throws SendEmailException
     */
    public function send(Email $email): void
    {
        $message = $this->messageFactory->create(
            $email->getSubject(),
            $email->getBody(),
            $email->getSender(),
            $email->getRecipient()
        );

        try{
            $this->mailer->send($message);
        } catch (Throwable $e) {
            throw new SendEmailException($e->getMessage(), $e->getCode(), $e);
        }
    }
}