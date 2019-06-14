<?php
declare(strict_types=1);

namespace App\Benchmark\Ui\Http\Rest;

use App\Shared\Ui\Http\Rest\RestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BenchmarkController
 * @package App\Benchmark\Ui\Http\Rest
 *
 * @Rest\Route("/api")
 */
class BenchmarkController extends RestController
{
    /**
     * @Rest\Route(path="/benchmark", methods={"GET"}, name="api-benchmark-create")
     *
     * @return Response
     */
    public function createBenchmark(): Response
    {

    }
}