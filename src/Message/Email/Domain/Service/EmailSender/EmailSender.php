<?php
declare(strict_types=1);

namespace App\Message\Email\Domain\Service\EmailSender;

use App\Message\Email\Domain\Model\Email;
use App\Shared\Exception\InfrastructureException;

class EmailSender
{
    /** @var MailerAdapter  */
    private $mailer;

    public function __construct(MailerAdapter $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @throws InfrastructureException
     */
    public function send(Email $email): void
    {
        $this->mailer->send($email);
    }
}