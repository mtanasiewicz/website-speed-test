<?php
declare(strict_types=1);

namespace App\Controller;

use App\Benchmark\Domain\LoadingTime\Service\LoadingTimeFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"})
     */
    public function index(LoadingTimeFactory $counter)
    {
        $time = $counter->create('http://wp.pl');

        return new JsonResponse($time->getValue());
    }
}