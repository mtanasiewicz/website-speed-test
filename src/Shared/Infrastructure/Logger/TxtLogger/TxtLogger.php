<?php
declare(strict_types=1);

namespace App\Shared\Infrastructure\Logger\TxtLogger;


use Psr\Log\LoggerInterface;

class TxtLogger
{
    /** @var LoggerInterface  */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function emergency(string $message, array $context = [])
    {
        $this->logger->emergency($message, $context);
    }

    public function alert(string $message, array $context = [])
    {
        $this->logger->emergency($message, $context);
    }

    public function critical(string $message, array $context = [])
    {
        $this->logger->emergency($message, $context);
    }

    public function error(string $message, array $context = [])
    {
        $this->logger->emergency($message, $context);
    }

    public function warning(string $message, array $context = [])
    {
        $this->logger->emergency($message, $context);
    }

    public function notice(string $message, array $context = [])
    {
        $this->logger->emergency($message, $context);
    }

    public function info(string $message, array $context = [])
    {
        $this->logger->emergency($message, $context);
    }

    public function debug(string $message, array $context = [])
    {
        $this->logger->emergency($message, $context);
    }
}