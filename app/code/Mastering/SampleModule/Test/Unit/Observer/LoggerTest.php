<?php
namespace Mastering\SampleModule\Test\Unit\Observer;

use Magento\Framework\Event;
use Magento\Framework\Event\Observer;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Mastering\SampleModule\Observer\Logger;

class LoggerTest extends TestCase
{
    private $loggerInterfaceMock;
    private $observerMock;
    private $eventMock;
    private $logger;

    protected function setUp(): void
    {
        $this->loggerInterfaceMock = $this->createMock(LoggerInterface::class);
        $this->observerMock = $this->createMock(Observer::class);
        $this->eventMock = $this->createMock(Event::class);
        $this->logger = new Logger($this->loggerInterfaceMock);
    }

    public function testExecute()
    {
        $this->observerMock->expects($this->exactly(2))
            ->method('getEvent')
            ->willReturn($this->eventMock);
        $this->eventMock->expects($this->exactly(2))
            ->method('getName')
            ->willReturn('string test');
        
        $this->loggerInterfaceMock->expects($this->once())
            ->method('debug')
            ->with($this->observerMock->getEvent()->getName());

        $this->logger->execute($this->observerMock);
        $this->assertInstanceOf(Logger::class, $this->logger);
    }
}