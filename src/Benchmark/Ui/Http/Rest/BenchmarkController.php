<?php
declare(strict_types=1);

namespace App\Benchmark\Ui\Http\Rest;

use App\Benchmark\Application\CreateLoadingTimeBenchmarkCommand;
use App\Benchmark\Application\CreateLoadingTimeBenchmarkHandler;
use App\Benchmark\Ui\Http\Form\BenchmarkForm;
use App\Benchmark\Ui\Http\Request\BenchmarkData;
use App\Shared\Exception\InfrastructureException;
use App\Shared\Ui\Http\Rest\RestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
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
     * @Rest\Route(
     *     path="/benchmark",
     *     methods={"POST"},
     *     name="api_benchmarks_create"
     * )
     *
     * @return Response
     */
    public function createBenchmark(Request $request, CreateLoadingTimeBenchmarkHandler $handler): Response
    {
        $benchmarkData = new BenchmarkData();

        $this->handleForm($request, BenchmarkForm::class, $benchmarkData);

        $command = new CreateLoadingTimeBenchmarkCommand(
            $benchmarkData->email,
            $benchmarkData->phoneNumber,
            $benchmarkData->benchmarkUrl,
            $benchmarkData->comparedUrls
        );

        try{
            $handler->handle($command);
        } catch (InfrastructureException $e) {
            $this->handleErrorView($e, Response::HTTP_CONFLICT);
        }


    }
}