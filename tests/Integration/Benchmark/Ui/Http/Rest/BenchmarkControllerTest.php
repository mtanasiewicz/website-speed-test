<?php
declare(strict_types=1);

namespace App\Tests\Integration\Benchmark\Ui\Http\Rest;

use App\Tests\Integration\IntegrationTestBase;
use Symfony\Component\HttpFoundation\Response;

class BenchmarkControllerTest extends IntegrationTestBase
{
    public function testCreateBenchmark(): void
    {
        $data = [
            'benchmarkUrl' => 'https://www.yahoo.com',
            'comparedUrls' => [
                'http://www.wp.pl',
                'http://www.google.pl',
            ],
            'email' => 'email@example.com',
            'phoneNumber' => '555-55-55'
        ];

        $response = $this->post('/api/benchmark', $data);
        $report = json_decode($response->getContent(), true);

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertSame('WEBSITE LOADING TIME BENCHMARK', $report['name']);
        $this->assertTrue(count($report['sections']) > 1);

        $countedData = 0;
        foreach ($report['sections'] as $section) {
            $countedData += count($section['data']);
        }

        $this->assertTrue($countedData > 0);
    }
}