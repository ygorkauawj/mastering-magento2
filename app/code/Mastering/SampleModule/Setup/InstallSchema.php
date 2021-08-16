<?php
namespace Mastering\SampleModule\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        $table = $installer->getConnection()
            ->newTable($installer->getTable('mastering_sample_item'))
            ->addColumn('id', Table::TYPE_INTEGER, null, ['identity' => true, 'nullable' => false, 'primary' => true], 'Item ID')
            ->addColumn('name', Table::TYPE_TEXT, 255, ['nullable' => false], 'Item Name')
            ->addColumn('price', Table::TYPE_FLOAT, [], [], 'Item price')
            ->addColumn('quantity', Table::TYPE_INTEGER, [], [], 'Item quantity')
            ->addColumn('tax', Table::TYPE_FLOAT, [], [], 'Item Tax Price')
            ->addIndex($installer->getIdxName('mastering_sample_item', ['name']), ['name'])
            ->setComment('Market items');
        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}
