<?php
namespace Pixelpro\Helloworld\Block\Adminhtml\Edit;
/**
 * Adminhtml blog post edit form
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;
    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }
    /**
     * Init form
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('post_form');
        //$this->setTitle(__('Datos del post'));
    }
    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        /** @var \Ashsmith\Blog\Model\Post $model */
        //$model = $this->_coreRegistry->registry('blog_post');
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']]
        );
        $form->setHtmlIdPrefix('post_');
        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('Post Data'), 'class' => 'fieldset-wide']
        );
       
        $fieldset->addField(
            'title',
            'text',
            ['name' => 'title', 'label' => __('Title'), 'titulo' => __('Title'), 'required' => true]
        );
        
        $fieldset->addField(
            'mime_content_type(filename)',
            'editor',
            [
                'name' => 'content',
                'label' => __('Content'),
                'title' => __('Content'),
                'style' => 'height:36em',
                'required' => true
            ]
        );
        //$form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}