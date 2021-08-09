<?php
namespace Mastering\SampleModule\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;

class config
{
    const XML_PATH_ENABLED = 'mastering/log/enable';

    private $config;

    public function __construct(ScopeConfigInterface $config)
    {
        $this->config = $config;
    }

    public function isEnabled()
    {
        return $this->config->getValue(self::XML_PATH_ENABLED);
    }
}
