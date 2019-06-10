<?php
declare(strict_types=1);

namespace App\Controller;

use App\Benchmark\Application\CreateLoadingTimeBenchmarkCommand;
use App\Benchmark\Application\CreateLoadingTimeBenchmarkHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"})
     */
    public function index(CreateLoadingTimeBenchmarkHandler $handler)
    {
        $command = new CreateLoadingTimeBenchmarkCommand(
            'user@example.com',
            '+555555555',
            'http://www.yahoo.com',
            [
                'http://www.onet.pl',
                'http://www.wp.pl',
                'http://www.google.com'
            ]
            );

        $result = $handler->handle($command);

        return new Response($result);
    }
}