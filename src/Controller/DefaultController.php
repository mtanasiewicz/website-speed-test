<?php
declare(strict_types=1);

namespace App\Controller;

use App\Message\Email\Application\SendEmailCommand;
use App\Message\Email\Application\SendEmailHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"})
     */
    public function index(SendEmailHandler $sendEmailHandler)
    {
        $command = new SendEmailCommand('user@example.com', 'some-subject', 'message-body');

        $sendEmailHandler->handle($command);

        return new JsonResponse('OK');
    }
}