<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\LoadingTime\Service;

use App\Benchmark\Domain\Exception\CouldNotConnectToUrlException;
use App\Benchmark\Domain\LoadingTime\Model\LoadingTime;
use App\Benchmark\Infrastructure\Service\WebConnector;

/**
 * Class LoadingTimeFactory
 * @package App\Benchmark\Domain\LoadingTime\Service
 */
class LoadingTimeFactory
{
    /**
     * @var WebConnector
     */
    private $connector;

    /**
     * LoadingTimeFactory constructor.
     * @param WebConnector $connector
     */
    public function __construct(WebConnector $connector)
    {
        $this->connector = $connector;
    }

    /**
     * @param string $url
     * @return LoadingTime - loading time of website in milliseconds
     * @throws CouldNotConnectToUrlException
     */
    public function create(string $url): LoadingTime
    {
        $timer = Timer::start();
        $this->connector->connect($url);
        $timer->stop();

        return new LoadingTime($url, $timer->getTimeInMilSeconds());
    }
}