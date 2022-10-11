<?php
declare(strict_types = 1);

namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Locale\Resolver;

class Edit extends \Magebit\Faq\Controller\Index\AbstractQuestionActions
{
    /**
     * @return void
     */
    public function execute()
    {
        $questionId = $this->getRequest()->getParam('id');
        /** @var \Magebit\Faq\Model\Question $model */
        $model = $this->_questionFactory->create();

        if ($questionId) {
            $model->load($questionId);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This question no longer exists.'));
                $this->_redirect('*/*/index');
                return;
            }
        } else {
            $model->setInterfaceLocale(Resolver::DEFAULT_LOCALE);
        }


        $this->_coreRegistry->register('question', $model);

        $this->_initAction();
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Question'));
        $this->_view->getPage()->getConfig()->getTitle()->prepend("FAQ Question");
        $this->_view->renderLayout();
    }
}
