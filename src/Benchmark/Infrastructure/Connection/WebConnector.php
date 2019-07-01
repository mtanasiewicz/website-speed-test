<?php
declare(strict_types=1);

namespace App\Benchmark\Infrastructure\Connection;

use App\Benchmark\Domain\Exception\InvalidUrlException;
use App\Benchmark\Infrastructure\Exception\CouldNotConnectToUrlException;

/**
 * Class WebConnector
 * @package App\Benchmark\Domain\Connection
 */
class WebConnector implements WebConnectorInterface
{
    private const TIMEOUT = 20;

    /**
     * @param string $url
     * @throws CouldNotConnectToUrlException
     */
    public function connect(string $url): void
    {
        $this->assertUrlIsValid($url);

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

    /**
     * @param string $url
     */
    private function assertUrlIsValid(string $url): void
    {
        if(!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new InvalidUrlException('Please provide a valid url');
        }
    }
}