<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\Connection\Service;


use App\Benchmark\Domain\Exception\CouldNotConnectToUrlException;

/**
 * Class WebConnector
 * @package App\Benchmark\Domain\Connection
 */
interface WebConnectorInterface
{
    /**
     * @param string $url
     * @throws CouldNotConnectToUrlException
     */
    public function connect(string $url): void;
}