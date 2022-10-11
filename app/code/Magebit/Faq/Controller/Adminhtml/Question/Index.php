<?php
declare(strict_types = 1);

namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_setActiveMenu('Magebit_Faq::faq');
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('FAQ'));
        $this->_view->getPage()->getConfig()->getTitle()->prepend("Frequently Asked Questions");
        $this->_view->renderLayout();
    }
}
