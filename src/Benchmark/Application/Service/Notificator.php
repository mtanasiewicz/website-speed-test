<?php
declare(strict_types=1);

namespace App\Benchmark\Application\Service;

use App\Benchmark\Domain\LoadingTime\Model\AllTimes;
use App\Message\Email\Application\SendEmailCommand;
use App\Message\Email\Application\SendEmailHandler;
use App\Message\Sms\Application\SendSmsCommand;
use App\Message\Sms\Application\SendSmsHandler;
use App\Shared\Exception\InfrastructureException;

class Notificator
{
    private const EMAIL_SUBJECT = 'Faster websites detected';

    /**
     * @var SendEmailHandler
     */
    private $sendEmailHandler;
    /**
     * @var SendSmsHandler
     */
    private $sendSmsHandler;

    /**
     * EmailNotificator constructor.
     * @param SendEmailHandler $sendEmailHandler
     * @param SendSmsHandler $sendSmsHandler
     */
    public function __construct(
        SendEmailHandler $sendEmailHandler,
        SendSmsHandler $sendSmsHandler
    )
    {
        $this->sendEmailHandler = $sendEmailHandler;
        $this->sendSmsHandler = $sendSmsHandler;
    }

    /**
     * @param string $recipient
     * @param string $phoneNumber
     * @param AllTimes $allTimes
     * @throws InfrastructureException
     */
    public function notifyAboutFasterWebsites(string $recipient, string $phoneNumber, AllTimes $allTimes): void
    {
        $fasterThanBenchmarkWebsitesCount = count($allTimes->getTimesFasterThanBenchmark());
        $twoTimesFasterThanBenchmarkWebsitesCount = count($allTimes->getTimesTwoTimesFasterThanBenchmark());

        if ($fasterThanBenchmarkWebsitesCount) {
            $this->notifyByEmail($recipient, $fasterThanBenchmarkWebsitesCount);
        }

        if ($twoTimesFasterThanBenchmarkWebsitesCount) {
            $this->notifyBySms($phoneNumber, $fasterThanBenchmarkWebsitesCount);
        }
    }

    /**
     * @param string $recipient
     * @param int $count
     * @throws InfrastructureException
     */
    private function notifyByEmail(string $recipient, int $count): void
    {
        $sendEmailCommand = new SendEmailCommand(
            $recipient, self::EMAIL_SUBJECT,
            "There have been $count faster websites detected during benchmark."
        );

        $this->sendEmailHandler->handle($sendEmailCommand);
    }

    /**
     * @param string $phoneNumber
     * @param int $count
     * @throws InfrastructureException
     */
    private function notifyBySms(string $phoneNumber, int $count): void
    {
        $sendSmsCommand = new SendSmsCommand(
            $phoneNumber,
            "There have been $count two times faster websites detected during benchmark."
        );

        $this->sendSmsHandler->handle($sendSmsCommand);
    }
}