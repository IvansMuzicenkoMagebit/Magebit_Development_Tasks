<?php
declare(strict_types = 1);

namespace Magebit\Faq\Controller\Adminhtml;

use Magebit\Faq\Model\QuestionFactory;
use Magento\Backend\App\AbstractAction;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;

abstract class AbstractQuestionActions extends AbstractAction
{
    /**
     * @var Registry
     */
    protected $_coreRegistry;

    /**
     * @var QuestionFactory
     */
    protected $_questionFactory;

    /**
     * @param Context $context
     * @param Registry $coreRegistry
     * @param QuestionFactory $questionFactory
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        QuestionFactory $questionFactory
    ) {
        parent::__construct($context);
        $this->_coreRegistry = $coreRegistry;
        $this->_questionFactory = $questionFactory;
    }

    protected function _initAction($resultPage)
    {
        $resultPage->setActiveMenu('Magebit_Faq::faq');
        $resultPage->getConfig()->getTitle()->prepend(__('Question'));
        $resultPage->getConfig()->getTitle()->prepend("FAQ Question");
        return $resultPage;
    }
}
