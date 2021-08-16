<?php
namespace Mastering\SampleModule\Test\Unit\Model;

use Mastering\SampleModule\Model\ItemRepository;
use PHPUnit\Framework\TestCase;
use Mastering\SampleModule\Model\ResourceModel\Item\CollectionFactory;
use Mastering\SampleModule\Model\ResourceModel\Item\Collection;

class ItemRepositoryTest extends TestCase
{
    private $collectionFactoryMock;
    private $collectionMock;
    private $itemRepository;

    protected function setUp(): void
    {
        $this->collectionFactoryMock = $this->createMock(CollectionFactory::class);
        $this->collectionMock = $this->createMock(Collection::class);
        $this->itemRepository = new ItemRepository($this->collectionFactoryMock);

        $this->assertInstanceOf(ItemRepository::class, $this->itemRepository);
        
    }

    public function testGetList()
    {
        $this->collectionFactoryMock->expects($this->once())
            ->method('create')
            ->willReturn($this->collectionMock);

        $this->collectionMock->expects($this->once())
            ->method('getItems')
            ->willReturn([]);
            
        $this->assertEquals([], $this->itemRepository->getList());
    }
}
