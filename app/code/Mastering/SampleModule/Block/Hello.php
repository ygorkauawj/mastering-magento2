<?php
namespace Mastering\SampleModule\Block;

use Magento\Framework\Event\Manager;
use Mastering\SampleModule\Model\ResourceModel\Item\Collection;
use Mastering\SampleModule\Model\ResourceModel\Item\CollectionFactory;
use \Magento\Framework\View\Element\Template\Context;
use Mastering\SampleModule\Model\configLog;

class Hello extends \Magento\Framework\View\Element\Template
{
    private CollectionFactory $collectionFactory;
    private $eventManager;
    private $config;

    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory,
        array $data = [],
        Manager $eventManager,
        ConfigLog $config
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->eventManager = $eventManager;
        $this->config = $config;
        parent::__construct($context, $data);
    }

    /**
     * @return \Mastering\SampleModule\Model\Item[]
     */
    public function getItems()
    {
        if ($this->config->isEnabled()) {
            $this->eventManager->dispatch('page_access');
        }
        return $this->collectionFactory->create()->getItems();
    }
}
