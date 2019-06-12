<?php
declare(strict_types=1);

namespace App\Tests\Unit\Benchmark\Domain\LoadingTime\Service;

use App\Benchmark\Domain\LoadingTime\Model\LoadingTime;
use App\Benchmark\Domain\LoadingTime\Service\LoadingTimeFactory;
use App\Benchmark\Infrastructure\WebConnector;
use App\Tests\Unit\UnitTestBase;

class LoadingTimeFactoryTest extends UnitTestBase
{
    private const URL = 'www.example.com';

    /**
     * @var WebConnector|\PHPUnit_Framework_MockObject_MockObject
     */
    private $webConnector;
    /**
     * @var LoadingTimeFactory
     */
    private $loadingTimeFactory;

    public function setUp()
    {
        parent::setUp();

        $this->webConnector = $this->createMock(WebConnector::class);
        $this->loadingTimeFactory = new LoadingTimeFactory($this->webConnector);
    }

    public function testItCreatesLoadingTime(): void
    {
        $this->webConnector
            ->method('connect')
            ->with(self::URL);

        $loadingTime = $this->loadingTimeFactory->create(self::URL);

        $this->assertInstanceOf(LoadingTime::class, $loadingTime);
        $this->assertInternalType('float', $loadingTime->getValue());
        $this->assertNotEquals(0, $loadingTime->getValue());
        $this->assertSame(self::URL, $loadingTime->getName());
    }
}