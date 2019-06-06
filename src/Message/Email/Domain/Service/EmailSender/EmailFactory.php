<?php
declare(strict_types=1);

namespace App\Message\Email\Domain\Service\EmailSender;

use App\Message\Email\Domain\Model\Email;

class EmailFactory
{
    public function create(string $recipient, string $sender, string $subject, string $body): Email
    {
        return new Email($recipient, $sender, $subject, $body);
    }
}