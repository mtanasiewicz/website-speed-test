<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\Connection;

class WebConnector
{
    public function connect(string $url): void
    {
        file($url);
    }
}