<?php
declare(strict_types=1);

namespace App\Tests\Unit\Benchmark\Domain\Report\Service\SimpleLoadingTimeReport;

use App\Benchmark\Domain\LoadingTime\Model\AllTimes;
use App\Benchmark\Domain\LoadingTime\Model\LoadingTime;
use App\Benchmark\Domain\Report\Model\Failed;
use App\Benchmark\Domain\Report\Model\Section;
use App\Benchmark\Domain\Report\Service\SimpleLoadingTimeReport\FailureSectionFactory;
use App\Tests\Unit\UnitTestBase;

class FailureSectionFactoryTest extends UnitTestBase
{
    private const MESSAGE = 'could not create test';
    private const FAILURE_URL = 'url';

    /**
     * @var FailureSectionFactory
     */
    private $failureSectionFactory;

    public function setUp()
    {
        parent::setUp();

        $this->failureSectionFactory = new FailureSectionFactory();
    }

    public function testItCreatesFailureSection(): void
    {
        $allTimes = new AllTimes(new LoadingTime('www.example.com', 1));
        $allTimes->addFailure(self::FAILURE_URL, self::MESSAGE);

        $failureSection = $this->failureSectionFactory->create($allTimes);
        $data = $failureSection->getData()[0];

        $this->assertInstanceOf(Section::class, $failureSection);
        $this->assertInstanceOf(Failed::class, $data);
        $this->assertSame(self::MESSAGE, $data->getValue());
        $this->assertSame(self::FAILURE_URL, $data->getName());
        $this->assertCount(1, $failureSection->getData());
    }
}