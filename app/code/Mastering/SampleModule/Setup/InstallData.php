<?php

namespace Mastering\SampleModule\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $setup->getConnection()->insert(
            $setup->getTable('mastering_sample_item'),
            [
                'name' => 'Fósforo',
                'price' => 2.50,
                'quantity' => 12,
                'tax' => 0.15
            ]
        );

        $setup->getConnection()->insert(
            $setup->getTable('mastering_sample_item'),
            [
                'name' => 'Desodorante',
                'price' => 8.90,
                'quantity' => 30,
                'tax' => 1.30
            ]
        );

        $setup->getConnection()->insert(
            $setup->getTable('mastering_sample_item'),
            [
                'name' => 'Cubo Mágico Profissional',
                'price' => 45.50,
                'quantity' => 3,
                'tax' => 3.40
            ]
        );

        $setup->getConnection()->insert(
            $setup->getTable('mastering_sample_item'),
            [
                'name' => 'Fone de Ouvido Auple',
                'price' => 10.50,
                'quantity' => 100,
                'tax' => 0.0
            ]
        );

        $setup->getConnection()->insert(
            $setup->getTable('mastering_sample_item'),
            [
                'name' => 'Afiador de faca',
                'price' => 149.90,
                'quantity' => 1,
                'tax' => 5.20
            ]
        );

        $setup->getConnection()->insert(
            $setup->getTable('mastering_sample_item'),
            [
                'name' => 'Chaveiro',
                'price' => 4.50,
                'quantity' => 12,
                'tax' => 0.40
            ]
        );

        $setup->getConnection()->insert(
            $setup->getTable('mastering_sample_item'),
            [
                'name' => 'Teclado para PC',
                'price' => 90.0,
                'quantity' => 8,
                'tax' => 12.50
            ]
        );
        $setup->endSetup();
    }
}