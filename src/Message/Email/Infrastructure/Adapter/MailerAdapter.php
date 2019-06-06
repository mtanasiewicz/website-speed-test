<?php
declare(strict_types=1);

namespace App\Message\Email\Infrastructure\Adapter;

use App\Message\Email\Domain\Model\Email;

interface MailerAdapter
{
    public function send(Email $email): void;
}