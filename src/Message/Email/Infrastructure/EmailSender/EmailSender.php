<?php
declare(strict_types=1);

namespace App\Message\Email\Infrastructure\EmailSender;

use App\Message\Email\Domain\Model\Email;
use App\Message\Email\Infrastructure\Adapter\MailerAdapter;

class EmailSender
{
    /** @var MailerAdapter  */
    private $mailer;

    public function __construct(MailerAdapter $mailer)
    {
        $this->mailer = $mailer;
    }

    public function send(Email $email): void
    {
        $this->mailer->send($email);
    }
}