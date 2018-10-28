<?php
namespace Pixelpro\Helloworld\Controller\Adminhtml\Post;
use Magento\Backend\App\Action;
use Magento\TestFramework\ErrorLog\Logger;
class Save extends \Magento\Backend\App\Action
{
    /**
     * @param Action\Context $context
     */
    public function __construct(Action\Context $context)
    {
        parent::__construct($context);
    }
    
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            /** @var \Ashsmith\Blog\Model\Post $model */
            $model = $this->_objectManager->create('Pixelpro\Helloworld\Model\Post');
            $model->setData($data);
            $this->_eventManager->dispatch(
                'blog_post_prepare_save',
                ['post' => $model, 'request' => $this->getRequest()]
            );
            try {
                $model->save();
                $this->messageManager->addSuccess(__('You saved this Post.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
              
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the post.'));
            }
            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit');
        }
        return $resultRedirect->setPath('*/*/');
    }
}