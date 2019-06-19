<?php
declare(strict_types=1);

namespace App\Tests\Integration;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class IntegrationTestBase extends WebTestCase
{
    protected function post(string $uri, $data): Response
    {
        $client = static::createClient();

        $client->request(
            'POST',
            $uri,
            ['content-type' => 'application/json'],
            [],
            [],
            json_encode($data)
        );

        return $client->getResponse();
    }
}