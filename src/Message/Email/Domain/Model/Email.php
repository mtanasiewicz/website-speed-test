<?php
declare(strict_types=1);

namespace App\Message\Email\Domain\Model;

class Email
{
    /** @var string  */
    private $recipient;

    /** @var string  */
    private $sender;

    /** @var string  */
    private $subject;

    /** @var string  */
    private $body;

    public function __construct(string $recipient, string $sender, string $subject, string $body)
    {
        $this->recipient = $recipient;
        $this->sender = $sender;
        $this->subject = $subject;
        $this->body = $body;
    }

    public function getRecipient(): string
    {
        return $this->recipient;
    }

    public function getSender(): string
    {
        return $this->sender;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getBody(): string
    {
        return $this->body;
    }
}