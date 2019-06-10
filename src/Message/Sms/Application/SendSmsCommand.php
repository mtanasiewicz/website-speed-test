<?php
declare(strict_types=1);

namespace App\Message\Sms\Application;

class SendSmsCommand
{
    /**
     * @var string
     */
    private $phoneNumber;
    /**
     * @var string
     */
    private $message;

    public function __construct(string $phoneNumber, string $message)
    {
        $this->phoneNumber = $phoneNumber;
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}