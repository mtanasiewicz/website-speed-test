<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\Connection;

use App\Benchmark\Domain\Exception\CouldNotConnectToUrlException;

class WebConnector
{
    private const TIMEOUT = 20;

    /**
     * @throws CouldNotConnectToUrlException
     */
    public function connect(string $url): void
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, self::TIMEOUT);

        $data = curl_exec($ch);
        curl_close($ch);

        if (!$data) {
            throw new CouldNotConnectToUrlException("$url could not be reached.");
        }
    }
}