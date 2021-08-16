<?php

namespace Mastering\SampleModule\Test\Unit\Block;

use PHPUnit\Framework\TestCase;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Event\Manager;
use Mastering\SampleModule\Block\Hello;
use Mastering\SampleModule\Model\ResourceModel\Item\Collection;
use Mastering\SampleModule\Model\ResourceModel\Item\CollectionFactory;
use Mastering\SampleModule\Model\ConfigLog;


class HelloTest extends TestCase
{
    private $contextMock;
    private $collectionFactoryMock;
    private $collectionMock;
    private $managerMock;
    private $configLogMock;
    private $hello;

    protected function setUp(): void
    {
        $this->contextMock = $this->createMock(Context::class);
        $this->collectionFactoryMock = $this->createMock(CollectionFactory::class);
        $this->collectionMock = $this->createMock(Collection::class);
        $this->managerMock = $this->createMock(Manager::class);
        $this->configLogMock = $this->createMock(ConfigLog::class);
        $this->hello = new Hello(
            $this->contextMock,
            $this->collectionFactoryMock,
            [],
            $this->managerMock,
            $this->configLogMock
        );

        $this->assertInstanceOf(Hello::class, $this->hello);
    }

    /**
     * @dataProvider dataProviderEvents
     */
    public function testGetItems(?bool $isENabled, int $exactlyEvent)
    {
        $this->configLogMock->expects($this->once())
            ->method('isEnabled')
            ->willReturn($isENabled);

        $this->managerMock->expects($this->exactly($exactlyEvent))
            ->method('dispatch')
            ->with('page_access');

        $this->collectionFactoryMock->expects($this->any())
            ->method('create')
            ->willReturn($this->collectionMock);

        $this->collectionMock->expects($this->any())
            ->method('getItems')
            ->willReturn([1, 2, 3, 4, 5]);

        $result = $this->hello->getItems();

        $this->assertEquals([1, 2, 3, 4, 5], $result);
        $this->assertCount(5, $result);
    }

    /**
     * @codeCoverageIgnore
     */
    public function dataProviderEvents(): array
    {
        return [
            'event dispatch' => [
                'isEnabled' => true,
                'exactlyEvent' => 1
            ],
            'event not dispatch' => [
                'isEnabled' => null,
                'exactlyEvent' => 0
            ]
        ];
    }
}
