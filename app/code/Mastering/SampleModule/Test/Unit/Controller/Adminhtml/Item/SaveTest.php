<?php

namespace Mastering\SampleModule\Test\Unit\Controller\Adminhtml\Item;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Mastering\SampleModule\Controller\Adminhtml\Item\Save;
use Mastering\SampleModule\Model\ItemFactory;
use Mastering\SampleModule\Model\Item;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Controller\Result\Redirect;
use PHPUnit\Framework\TestCase;

class SaveTest extends TestCase
{
    private $saveController;
    private $contextMock;
    private $itemFactoryMock;
    private $requestInterfaceMock;
    private $resultRedirectFactoryMock;
    private $redirectMock;
    private $itemMock;

    protected function setUp(): void
    {
        $this->contextMock = $this->createMock(Context::class);
        $this->itemFactoryMock = $this->createMock(ItemFactory::class);
        $this->itemMock = $this->getMockBuilder(Item::class)
            ->disableOriginalConstructor()
            ->setMethods(['save', 'setData'])
            ->getMock();
        $this->requestInterfaceMock = $this->getMockBuilder(RequestInterface::class)
            ->disableOriginalConstructor()
            ->setMethods(['getPostValue'])
            ->getMockForAbstractClass();
        $this->resultRedirectFactoryMock = $this->createMock(RedirectFactory::class);
        $this->redirectMock = $this->createMock(Redirect::class);
        $this->contextMock->method('getRequest')->willReturn($this->requestInterfaceMock);
        $this->contextMock->method('getResultRedirectFactory')->willReturn($this->resultRedirectFactoryMock);
        $this->saveController = new Save($this->contextMock, $this->itemFactoryMock);
    }

    public function testExecute()
    {
        $this->itemFactoryMock
            ->method('create')
            ->willReturn($this->itemMock);
        $this->requestInterfaceMock->expects($this->once())
            ->method('getPostValue')
            ->willReturn(['general' => ['teste']]);
        $this->resultRedirectFactoryMock->expects($this->once())
            ->method('create')
            ->willReturn($this->redirectMock);
        $this->redirectMock->expects($this->once())
            ->method('setPath')
            ->with('mastering/index/index')
            ->willReturnSelf();

        $this->itemMock->expects($this->once())
            ->method('setData')
            ->with(['teste'])
            ->willReturnSelf();

        $this->itemMock->expects($this->once())
            ->method('save')
            ->willReturnSelf();

        $result = $this->saveController->execute();
        $this->assertEquals($this->redirectMock, $result);
    }
}