<?php
declare(strict_types=1);

namespace App\Message\Email\Infrastructure\Adapter\SwiftMailer;

use App\Message\Email\Domain\Model\Email;
use App\Message\Email\Infrastructure\Adapter\MailerAdapter;
use Swift_Mailer;
use Throwable;

class SwiftMailerAdapter implements MailerAdapter
{
    /** @var MessageFactory  */
    private $messageFactory;

    /** @var Swift_Mailer  */
    private $mailer;

    /** @var string  */
    private $sender;

    public function __construct(MessageFactory $messageFactory, Swift_Mailer $mailer, string $sender)
    {
        $this->messageFactory = $messageFactory;
        $this->mailer = $mailer;
        $this->sender = $sender;
    }

    public function send(Email $email): void
    {
        $message = $this->messageFactory->create(
            $email->getSubject(),
            $email->getBody(),
            $this->sender,
            $email->getRecipient()
        );

        try{
            $this->mailer->send($message);
        } catch (Throwable $e) {

        }
    }
}