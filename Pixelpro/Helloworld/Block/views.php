<?php
namespace Pixelpro\Helloworld\Block;
class Views extends \Magento\Framework\View\Element\Template
{
	protected $_postFactory;
	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Pixelpro\Helloworld\Model\PostFactory $postFactory
	)
	{
		$this->_postFactory = $postFactory;
		parent::__construct($context);
	}
	public function getPostCollection(){
		$post = $this->_postFactory->create();
		return $post->getCollection();
	}
}