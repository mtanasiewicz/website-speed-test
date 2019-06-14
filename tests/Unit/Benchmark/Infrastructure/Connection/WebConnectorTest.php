<?php
declare(strict_types=1);

namespace App\Tests\Unit\Benchmark\Infrastructure\Connection;

use App\Benchmark\Domain\Exception\CouldNotConnectToUrlException;
use App\Benchmark\Domain\Exception\InvalidUrlException;
use App\Benchmark\Infrastructure\Connection\WebConnector;
use App\Tests\Unit\UnitTestBase;

class WebConnectorTest extends UnitTestBase
{
    /**
     * @var WebConnector
     */
    private $webConnector;

    public function setUp()
    {
        parent::setUp();

        $this->webConnector = new WebConnector();
    }

    public function testItThrowsExceptionWhenUrlIsInvalid(): void
    {
        $this->expectException(InvalidUrlException::class);

        $this->webConnector->connect('invalid url');
    }

    public function testItThrowsExceptionWhenCouldNotConnectToWebsite(): void
    {
        $this->expectException(CouldNotConnectToUrlException::class);

        $this->webConnector->connect('http://website-that-does-not-exist.for.sure');
    }
}