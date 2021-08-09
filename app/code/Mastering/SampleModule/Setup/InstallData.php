<?php
namespace Mastering\SampleModule\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $setup->getConnection()->insert(
            $setup->getTable('mastering_sample_item'),
            [
                'name' => 'Item 1'
            ]
            );

        $setup->getConnection()->insert(
            $setup->getTable('mastering_sample_item'),
            [
                'name' => 'Item 2'
            ]
            );

        $setup->endSetup();
    }
}