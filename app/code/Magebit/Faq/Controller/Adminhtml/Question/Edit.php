<?php
declare(strict_types = 1);

namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magebit\Faq\Controller\Adminhtml\AbstractQuestionActions;
use Magebit\Faq\Model\Question;
use Magebit\Faq\Model\QuestionFactory;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;

class Edit extends AbstractQuestionActions
{

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param Registry $coreRegistry
     * @param QuestionFactory $questionFactory
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        QuestionFactory $questionFactory,
        PageFactory $resultPageFactory
    )
    {
        parent::__construct($context, $coreRegistry, $questionFactory);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $questionId = $this->getRequest()->getParam('id');
        /** @var Question $model */
        $model = $this->_questionFactory->create();

        if ($questionId) {
            $model->load($questionId);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This question no longer exists.'));
                return $this->_redirect('*/*/index');
            }
        }

        $this->_coreRegistry->register('question', $model);

        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->_initAction($resultPage);
        return $resultPage;
    }
}
