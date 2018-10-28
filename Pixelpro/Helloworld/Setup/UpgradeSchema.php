<?php
namespace Pixelpro\Helloworld\Setup;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
class UpgradeSchema implements UpgradeSchemaInterface
{
	public function upgrade( SchemaSetupInterface $setup, ModuleContextInterface $context ) {
		$installer = $setup;
		$installer->startSetup();
		if(version_compare($context->getVersion(), '1.1.0', '<')) {
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
		}
		$installer->endSetup();
	}
}