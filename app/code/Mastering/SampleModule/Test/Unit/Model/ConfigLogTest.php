<?php

namespace Mastering\SampleModule\Test\Unit\Model;

use PHPUnit\Framework\TestCase;
use Mastering\SampleModule\Model\ConfigLog;
use Magento\Framework\App\Config\ScopeConfigInterface;

class ConfigLogTest extends TestCase
{
    /**
     * @var ConfigLog
     */
    private $configLog;

    /**
     * @var ScopeConfigInterface
     */
    private $interfaceMock;

    protected function setUp(): void
    {
        $this->interfaceMock = $this->createMock(ScopeConfigInterface::class);
        $this->configLog = new ConfigLog($this->interfaceMock);

        $this->assertInstanceOf(ConfigLog::class, $this->configLog);
    }

    /**
     * @dataProvider returnProvider
     */
    public function testIsEnabled($value, $expected)
    {
        $this->interfaceMock->expects($this->once())
            ->method('getValue')
            ->with(ConfigLog::XML_PATH_ENABLED)
            ->willReturn($value);
        $this->assertEquals($expected, $this->configLog->isEnabled());
    }

    /**
     * @codeCoverageIgnore
     */
    public function returnProvider()
    {
        return [
            'enabled' => [1, true],
            'disabled' => [0, false]
        ];
    }
}
