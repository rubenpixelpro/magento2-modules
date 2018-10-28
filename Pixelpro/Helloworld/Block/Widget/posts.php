<?php 
namespace Pixelpro\Helloworld\Block\Widget;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface; 
 
class Posts extends Template implements BlockInterface {
	protected $_template = "widget/posts.phtml";
}