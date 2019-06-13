<?php
declare(strict_types=1);

namespace App\Tests\Unit\Benchmark\Application;

use App\Benchmark\Application\Service\Notificator;
use App\Benchmark\Domain\LoadingTime\Model\AllTimes;
use App\Benchmark\Domain\LoadingTime\Model\LoadingTime;
use App\Message\Email\Application\SendEmailCommand;
use App\Message\Email\Application\SendEmailHandler;
use App\Message\Sms\Application\SendSmsCommand;
use App\Message\Sms\Application\SendSmsHandler;
use App\Shared\Exception\InfrastructureException;
use App\Tests\Unit\UnitTestBase;
use PHPUnit\Framework\MockObject\MockObject;

class NotificatorTest extends UnitTestBase
{
    private const RECIPIENT = 'email@example.com';
    private const PHONE_NUMBER = '555-55-55';
    private const BENCHMARK_URL = 'www.example.com';
    private const COMPARED_URL = 'www.example.io';

    /**
     * @var MockObject|SendEmailHandler
     */
    private $sendEmailHandler;
    /**
     * @var MockObject|SendSmsHandler
     */
    private $sendSmsHandler;
    /**
     * @var Notificator
     */
    private $notificator;

    public function setUp()
    {
        parent::setUp();

        $this->sendEmailHandler = $this->createMock(SendEmailHandler::class);
        $this->sendSmsHandler = $this->createMock(SendSmsHandler::class);
        $this->notificator = new Notificator($this->sendEmailHandler, $this->sendSmsHandler);
    }

    /**
     * @throws InfrastructureException
     */
    public function testThatItDoesntNotifyWhenThereAreNoFasterWebsites(): void
    {
        $allTimes = $this->createAllTimes(5, 6);

        $this->sendEmailHandler
            ->expects($this->exactly(0))
            ->method('handle');

        $this->sendSmsHandler
            ->expects($this->exactly(0))
            ->method('handle');

        $this->notificator->notifyAboutFasterWebsites(self::RECIPIENT, self::PHONE_NUMBER, $allTimes);
    }

    /**
     * @throws InfrastructureException
     */
    public function testThatItNotifiesOnlyByEmailWhenThereAreNoTwoTimesFasterWebsites(): void
    {
        $allTimes = $this->createAllTimes(5, 4);

        $this->sendEmailHandler
            ->expects($this->once())
            ->method('handle')
            ->with($this->isInstanceOf(SendEmailCommand::class));

        $this->sendSmsHandler
            ->expects($this->exactly(0))
            ->method('handle');

        $this->notificator->notifyAboutFasterWebsites(self::RECIPIENT, self::PHONE_NUMBER, $allTimes);
    }

    /**
     * @throws InfrastructureException
     */
    public function testThatItNotifiesByEmailAndSmsWhenThereAreTwoTimesFasterWebsitesInBenchmark(): void
    {
        $allTimes = $this->createAllTimes(5, 2.5);

        $this->sendEmailHandler
            ->expects($this->once())
            ->method('handle')
            ->with($this->isInstanceOf(SendEmailCommand::class));

        $this->sendSmsHandler
            ->expects($this->once())
            ->method('handle')
            ->with($this->isInstanceOf(SendSmsCommand::class));

        $this->notificator->notifyAboutFasterWebsites(self::RECIPIENT, self::PHONE_NUMBER, $allTimes);
    }

    /**
     * @param float $benchmarkLoadingTime
     * @param float $comparedLoadingTime
     * @return AllTimes
     */
    private function createAllTimes(float $benchmarkLoadingTime, float $comparedLoadingTime): AllTimes
    {
        $allTimes = new AllTimes(new LoadingTime(self::BENCHMARK_URL, $benchmarkLoadingTime));
        $allTimes->addComparedLoadingTime(new LoadingTime(self::COMPARED_URL, $comparedLoadingTime));

        return $allTimes;
    }
}