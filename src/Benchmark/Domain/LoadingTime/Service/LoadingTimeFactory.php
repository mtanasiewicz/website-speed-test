<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\LoadingTime\Service;

use App\Benchmark\Domain\Exception\CouldNotConnectToUrlException;
use App\Benchmark\Domain\LoadingTime\Model\LoadingTime;
use App\Benchmark\Infrastructure\Connection\WebConnectorInterface;

/**
 * Class LoadingTimeFactory
 * @package App\Benchmark\Domain\LoadingTime\Service
 */
class LoadingTimeFactory
{
    /**
     * @var WebConnectorInterface
     */
    private $connector;
    /**
     * @var TimerFactory
     */
    private $timerFactory;

    /**
     * LoadingTimeFactory constructor.
     * @param WebConnectorInterface $connector
     * @param TimerFactory $timerFactory
     */
    public function __construct(WebConnectorInterface $connector, TimerFactory $timerFactory)
    {
        $this->connector = $connector;
        $this->timerFactory = $timerFactory;
    }

    /**
     * @param string $url
     * @return LoadingTime - loading time of website in milliseconds
     * @throws CouldNotConnectToUrlException
     */
    public function create(string $url): LoadingTime
    {
        $timer = $this->timerFactory->create();

        $timer->start();
        $this->connector->connect($url);
        $timer->stop();

        return new LoadingTime($url, $timer->getTimeInMilSeconds());
    }
}