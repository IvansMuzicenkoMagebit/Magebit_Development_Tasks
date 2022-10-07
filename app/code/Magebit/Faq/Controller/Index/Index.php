<?php

namespace Magebit\Faq\Controller\Index;

use Magebit\Faq\Model\QuestionFactory;
use Magento\Backend\App\AbstractAction;

abstract class Index extends AbstractAction
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Magento_User::acl_users';

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     *
     * @var QuestionFactory
     */
    protected $_questionFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param QuestionFactory $questionFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        QuestionFactory $questionFactory
    ) {
        parent::__construct($context);
        $this->_coreRegistry = $coreRegistry;
        $this->_questionFactory = $questionFactory;
    }

    protected function _initAction()
    {
        $this->_view->loadLayout();
        $this->_setActiveMenu(
            'Magento_faq::home'
        );
        return $this;
    }
}
