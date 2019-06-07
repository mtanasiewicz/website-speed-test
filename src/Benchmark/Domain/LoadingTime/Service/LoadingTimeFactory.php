<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\LoadingTime\Service;

use App\Benchmark\Domain\Exception\InvalidUrlException;
use App\Benchmark\Domain\LoadingTime\Model\LoadingTime;
use App\Shared\Exception\InvalidArgumentException;

class LoadingTimeFactory
{
    /**
     * @return LoadingTime - time of website loading in seconds
     *
     * @throws InvalidArgumentException
     */
    public function create(string $url): LoadingTime
    {
        $this->assertUrlIsValid($url);

        $timer = Timer::start();
        file($url);
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