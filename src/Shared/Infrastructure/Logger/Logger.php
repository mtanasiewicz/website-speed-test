<?php
declare(strict_types=1);

namespace App\Shared\Infrastructure\Logger;

interface Logger
{
    public function emergency(string $message, array $context = []);

    public function alert(string $message, array $context = []);

    public function critical(string $message, array $context = []);

    public function error(string $message, array $context = []);

    public function warning(string $message, array $context = []);

    public function notice(string $message, array $context = []);

    public function info(string $message, array $context = []);

    public function debug(string $message, array $context = []);

    public function log($level, string $message, array $context = []);
}