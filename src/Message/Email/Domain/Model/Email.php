<?php
declare(strict_types=1);

namespace App\Message\Email\Domain\Model;

class Email
{
    private $recipient;

    private $subject;

    private $body;

    public function __construct($recipient, $subject, $body)
    {
        $this->recipient = $recipient;
        $this->subject = $subject;
        $this->body = $body;
    }

    public function getRecipient()
    {
        return $this->recipient;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function getBody()
    {
        return $this->body;
    }
}