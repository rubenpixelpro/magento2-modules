<?php
namespace Pixelpro\Helloworld\Model\ResourceModel\Post;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'post_id';
	protected $_eventPrefix = 'pixelpro_helloworld_post_collection';
	protected $_eventObject = 'post_collection';
	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Pixelpro\Helloworld\Model\Post', 'Pixelpro\Helloworld\Model\ResourceModel\Post');
	}
}