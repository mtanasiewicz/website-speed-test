<?php
declare(strict_types=1);

namespace App\Shared\Infrastructure\Logger\TxtLogger;

use App\Shared\Infrastructure\Logger\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Logger as Monolog;
use Psr\Log\LoggerInterface;

class TxtLogger implements Logger
{
    private const NAME = 'txt_logger';

    /** @var LoggerInterface  */
    private $logger;

    /**
     * TxtLogger constructor.
     * @param string $logPath
     * @throws \Exception
     */
    public function __construct(string $logPath)
    {
        $this->logger = new Monolog(self::NAME, [new StreamHandler($logPath)]);
    }

    /**
     * @param string $message
     * @param array $context
     */
    public function emergency(string $message, array $context = [])
    {
        $this->logger->emergency($message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     */
    public function alert(string $message, array $context = [])
    {
        $this->logger->alert($message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     */
    public function critical(string $message, array $context = [])
    {
        $this->logger->critical($message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     */
    public function error(string $message, array $context = [])
    {
        $this->logger->error($message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     */
    public function warning(string $message, array $context = [])
    {
        $this->logger->warning($message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     */
    public function notice(string $message, array $context = [])
    {
        $this->logger->notice($message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     */
    public function info(string $message, array $context = [])
    {
        $this->logger->info($message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     */
    public function debug(string $message, array $context = [])
    {
        $this->logger->debug($message, $context);
    }

    /**
     * @param $level
     * @param string $message
     * @param array $context
     */
    public function log($level, string $message, array $context = [])
    {
        $this->logger->log($level, $message, $context);
    }
}