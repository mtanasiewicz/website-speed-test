<?php
declare(strict_types=1);

namespace App\Message\Sms\Domain\Model;

/**
 * Class Sms
 * @package App\Message\Sms\Domain\Model
 */
class Sms
{
    /**
     * @var string
     */
    private $message;
    /**
     * @var string
     */
    private $phoneNumber;

    public function __construct(string $message, string $phoneNumber)
    {
        $this->message = $message;
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }
}