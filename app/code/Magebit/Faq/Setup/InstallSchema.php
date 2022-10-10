<?php
namespace Magebit\Faq\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context): void
    {
        $setup->startSetup();

        $table = $setup->getConnection()->newTable(
            $setup->getTable("magebit_faq")
        )->addColumn(
            "id",
            Table::TYPE_INTEGER,
            null,
            ["identity" => true, "nullable" => false, "primary" => true],
            "Item ID"
        )->addColumn(
            "question",
            Table::TYPE_TEXT,
            255,
            ["nullable" => false]
        )->addColumn(
            "answer",
            Table::TYPE_TEXT,
            1000,
            ["nullable" => false]
        )->addColumn(
            "status",
            Table::TYPE_SMALLINT,
            null,
            ["nullable" => false, "default" => 0]
        )->addColumn(
            "position",
            Table::TYPE_INTEGER,
            null,
            ["nullable" => false, "default" => 0]
        )->addColumn(
            "updated_at",
            Table::TYPE_TIMESTAMP,
            null,
            ["nullable" => false, "default" => time(), "on_update" => true]
        )->addIndex(
            $setup->getIdxName("magebit_faq", ["id"]),
            ["id"]
        );

        $setup->getConnection()->createTable($table);

        $setup->endSetup();
    }
}
