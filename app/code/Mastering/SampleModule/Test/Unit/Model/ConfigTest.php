<?php

namespace Mastering\SampleModule\Test\Unit\Model;

use PHPUnit\Framework\TestCase;
use Mastering\SampleModule\Model\Config;
use Magento\Framework\App\Config\ScopeConfigInterface;

class ConfigTest extends TestCase
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var ScopeConfigInterface
     */
    private $interfaceMock;

    protected function setUp(): void
    {
        $this->interfaceMock = $this->createMock(ScopeConfigInterface::class);
        $this->config = new Config($this->interfaceMock);

        $this->assertInstanceOf(Config::class, $this->config);
    }

    /**
     * @dataProvider returnProvider
     */
    public function testIsEnabled($value, $expected)
    {
        $this->interfaceMock->expects($this->once())
            ->method('getValue')
            ->with(Config::XML_PATH_ENABLED)
            ->willReturn($value);
        $this->assertEquals($expected, $this->config->isEnabled());
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
