<?php
namespace Pixelpro\Helloworld\Setup;
class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
	public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
	{
		$installer = $setup;
		$installer->startSetup();
		if (!$installer->tableExists('pixelpro_helloworld_post')) {
			$table = $installer->getConnection()->newTable(
				$installer->getTable('pixelpro_helloworld_post')
			)
				->addColumn(
					'post_id',
					\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
					null,
					[
						'identity' => true,
						'nullable' => false,
						'primary'  => true,
						'unsigned' => true,
					],
					'Post ID'
				)
				->addColumn(
					'title',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					['nullable => false'],
					'Title'
				)
				->addColumn(
					'content',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					'64k',
					[],
					'Content'
				)
				
				->setComment('Post Table');
			$installer->getConnection()->createTable($table);
			$installer->getConnection()->addIndex(
				$installer->getTable('pixelpro_helloworld_post'),
				$setup->getIdxName(
					$installer->getTable('pixelpro_helloworld_post'),
					['title','content'],
					\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
				),
				['title','content'],
				\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
			);
		}
		$installer->endSetup();
	}
}