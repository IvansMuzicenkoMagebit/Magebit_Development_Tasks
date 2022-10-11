<?php
declare(strict_types = 1);

namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magebit\Faq\Model\QuestionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;


class Delete extends \Magebit\Faq\Controller\Index\AbstractQuestionActions
{
    public function execute()
    {
        $questionId = $this->getRequest()->getParam('id');
        /** @var \Magebit\Faq\Model\Question $model */
        $model = $this->_questionFactory->create();

        if ($questionId) {
            $model->load($questionId);
            $model->delete();
        }
        return $this->resultRedirectFactory->create()->setPath("faq/question/index");
    }
}
