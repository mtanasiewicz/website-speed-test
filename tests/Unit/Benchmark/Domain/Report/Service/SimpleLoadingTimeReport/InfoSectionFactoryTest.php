<?php
declare(strict_types=1);

namespace App\Tests\Unit\Benchmark\Domain\Report\Service\SimpleLoadingTimeReport;

use App\Benchmark\Domain\LoadingTime\Model\AllTimes;
use App\Benchmark\Domain\LoadingTime\Model\LoadingTime;
use App\Benchmark\Domain\Report\Service\SimpleLoadingTimeReport\InfoSectionFactory;
use App\Tests\Unit\UnitTestBase;

class InfoSectionFactoryTest extends UnitTestBase
{
    /**
     * @var InfoSectionFactory
     */
    private $infoSectionFactory;

    public function setUp()
    {
        parent::setUp();

        $this->infoSectionFactory = new InfoSectionFactory();
    }

    public function testThatItCreatesInfoSection(): void
    {
        $allTimes = $this->createAllTimes();

        $infoSection = $this->infoSectionFactory->create($allTimes);
        $data = $infoSection->getData();

        $this->assertSame('benchmark', $data[0]->getName());
        $this->assertSame('faster1', $data[1]->getName());
        $this->assertSame('faster2', $data[2]->getName());
        $this->assertSame('slower', $data[3]->getName());
        $this->assertEquals(5.0, $data[0]->getValue());
        $this->assertEquals(4.0, $data[1]->getValue());
        $this->assertEquals(4.99, $data[2]->getValue());
        $this->assertEquals(5.01, $data[3]->getValue());
        $this->assertCount(4, $data);
        $this->assertSame(InfoSectionFactory::SECTION_TITLE, $infoSection->getTitle());
    }

    /**
     * @return AllTimes
     */
    private function createAllTimes(): AllTimes
    {
        $allTimes = new AllTimes(new LoadingTime('benchmark', 5.0));
        $allTimes->addComparedLoadingTime(new LoadingTime('faster1', 4.0));
        $allTimes->addComparedLoadingTime(new LoadingTime('faster2', 4.99));
        $allTimes->addComparedLoadingTime(new LoadingTime('slower', 5.01));

        return $allTimes;
    }
}