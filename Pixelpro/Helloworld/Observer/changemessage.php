<?php
namespace Pixelpro\Helloworld\Observer;
class ChangeMessage implements \Magento\Framework\Event\ObserverInterface
{
	public function execute(\Magento\Framework\Event\Observer $observer)
	{
		$message = $observer->getData('message_text');
		echo $message->getMessage() . " - Event </br>";
		$message->setMessage('Event launched successfully');
		return $this;
	}
}