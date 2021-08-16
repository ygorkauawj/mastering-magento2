<?php
namespace Mastering\SampleModule\Test\Unit\Controller\Adminhtml\Index;

use PHPUnit\Framework\TestCase;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Mastering\SampleModule\Controller\Adminhtml\Index\Index;
use Magento\Framework\View\Result\Page;

class IndexTest extends TestCase
{
    private $contextMock;
    private $pageFactoryMock;
    private $pageMock;
    private $index;

    protected function setUp(): void
    {
        $this->contextMock = $this->createMock(Context::class);
        $this->pageFactoryMock = $this->createMock(PageFactory::class);
        $this->pageMock = $this->createMock(Page::class);
        $this->index = new Index($this->contextMock, $this->pageFactoryMock);

        $this->assertInstanceOf(Index::class, $this->index);
    }

    public function testExecute()
    {
        $this->pageFactoryMock->expects($this->once())
        ->method('create')
        ->willReturn($this->pageMock);

        $this->assertEquals($this->pageMock, $this->index->execute());
    }
}
