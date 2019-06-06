<?php
declare(strict_types=1);

namespace App\Message\Email\Infrastructure\Adapter\SwiftMailer;

use Swift_Message;

class MessageFactory
{
    public function create(string $subject, string $body, string $sender, string $recipient): Swift_Message
    {
        $message =  new Swift_Message(
            $subject,
            $body
        );

        $message->setFrom($sender);
        $message->setTo($recipient);

        return $message;
    }
}