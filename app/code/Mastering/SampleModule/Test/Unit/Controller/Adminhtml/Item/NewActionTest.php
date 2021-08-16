<?php

namespace Mastering\SampleModule\Test\Unit\Controller\Adminhtml\Item;

use PHPUnit\Framework\TestCase;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Result\Page;
use Mastering\SampleModule\Controller\Adminhtml\Item\NewAction;

class NewActionTest extends TestCase
{
    private $contextMock;
    private $pageFactoryMock;
    private $pageMock;
    private $newAction;

    protected function setUp(): void
    {
        $this->contextMock = $this->createMock(Context::class);
        $this->pageFactoryMock = $this->createMock(PageFactory::class);
        $this->pageMock = $this->createMock(Page::class);
        $this->newAction = new NewAction($this->contextMock, $this->pageFactoryMock);

        $this->assertInstanceOf(NewAction::class, $this->newAction);
    }

    public function testExecute()
    {
        $this->pageFactoryMock->expects($this->once())
        ->method('create')
        ->willReturn($this->pageMock);

        $this->assertEquals($this->pageMock, $this->newAction->execute());
    }
}