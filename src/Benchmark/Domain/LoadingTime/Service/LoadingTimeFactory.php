<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\LoadingTime\Service;

use App\Benchmark\Domain\Connection\WebConnector;
use App\Benchmark\Domain\Exception\CouldNotConnectToUrlException;
use App\Benchmark\Domain\Exception\InvalidUrlException;
use App\Benchmark\Domain\LoadingTime\Model\LoadingTime;
use App\Shared\Exception\InvalidArgumentException;

class LoadingTimeFactory
{

    /** @var WebConnector  */
    private $connector;

    public function __construct(WebConnector $connector)
    {
        $this->connector = $connector;
    }

    /**
     * @return LoadingTime - time of website loading in seconds
     *
     * @throws InvalidArgumentException
     * @throws CouldNotConnectToUrlException
     */
    public function create(string $url): LoadingTime
    {
        $this->assertUrlIsValid($url);

        $timer = Timer::start();
        $this->connector->connect($url);
        $timer->stop();

        return new LoadingTime($url, $timer->getTimeInMilSeconds());
    }

    /**
     * @throws InvalidArgumentException
     */
    private function assertUrlIsValid(string $url): void
    {
        if(!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new InvalidUrlException('Please provide a valid url');
        }
    }
}