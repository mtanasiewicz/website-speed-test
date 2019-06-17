<?php
declare(strict_types=1);

namespace App\Tests\Integration;

use FOS\RestBundle\Tests\Functional\WebTestCase;

class IntegrationTestBase extends WebTestCase
{
    public function testCreateBenchmark(): void
    {
        $client = static::createClient();

        $client->request();
    }
}