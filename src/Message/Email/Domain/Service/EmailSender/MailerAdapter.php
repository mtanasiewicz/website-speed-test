<?php
declare(strict_types=1);

namespace App\Message\Email\Domain\Service\EmailSender;

use App\Message\Email\Domain\Model\Email;
use App\Shared\Exception\InfrastructureException;

interface MailerAdapter
{
    /**
     * @throws InfrastructureException
     */
    public function send(Email $email): void;
}