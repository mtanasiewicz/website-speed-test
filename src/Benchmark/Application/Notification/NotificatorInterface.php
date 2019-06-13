<?php
declare(strict_types=1);

namespace App\Benchmark\Application\Notification;

use App\Benchmark\Domain\LoadingTime\Model\AllTimes;
use App\Shared\Exception\InfrastructureException;

interface NotificatorInterface
{
    /**
     * @param string $recipient
     * @param string $phoneNumber
     * @param AllTimes $allTimes
     * @throws InfrastructureException
     */
    public function notifyAboutFasterWebsites(string $recipient, string $phoneNumber, AllTimes $allTimes): void;
}