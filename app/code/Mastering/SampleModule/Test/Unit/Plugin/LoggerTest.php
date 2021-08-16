<?php
namespace Mastering\SampleModule\Test\Unit\Plugin;

use PHPUnit\Framework\TestCase;
use Mastering\SampleModule\Console\Command\AddItem;
use Mastering\SampleModule\Plugin\Logger;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use function PHPUnit\Framework\assertInstanceOf;

class LoggerTest extends TestCase
{
    private $outputMock;
    private $addItemMock;
    private $inputMock;
    private $closureMock;
    private $logger;

    protected function setUp(): void
    {
        $this->outputMock = $this->createMock(OutputInterface::class);
        $this->addItemMock = $this->createMock(AddItem::class);
        $this->inputMock = $this->createMock(InputInterface::class); 
        //$this->closureMock = $this->createMock(\Closure::fromCallable(callable $calleable));
        $this->logger = new Logger();
    }

    public function testBeforeRun()
    {
        $this->logger->beforeRun($this->addItemMock, $this->inputMock, $this->outputMock);
        $this->outputMock->expects($this->any())
            ->method('writeln')
            ->with('beforeExecute');
        assertInstanceOf(Logger::class, $this->logger);
    }

    public function testAfterRun()
    {
        $this->logger->afterRun($this->addItemMock, [], $this->inputMock, $this->outputMock);
        $this->outputMock->expects($this->any())
            ->method('writeln')
            ->with('afterExecute');
        assertInstanceOf(Logger::class, $this->logger);
    }

    // public function testAroundRun()
    // {
    //     $this->logger->aroundRun($this->addItemMock, $this->closureMock, $this->inputMock, $this->outputMock);
    //     $this->outputMock->expects($this->any())
    //     ->method('writeln')
    //     ->with('aroundExecute before call')
    //     ->willReturn('');

    //     $this->closureMock->expects($this->any())
    //     ->method('call')
    //     ->with($this->addItem, $this->input, $this->output)
    //     ->willReturn('');

    //     $this->outputMock->expects($this->any())
    //     ->method('writeln')
    //     ->with('aroundExecute after call')
    //     ->willReturn('');
    //     assertInstanceOf(Logger::class, $this->logger);
    // }
}