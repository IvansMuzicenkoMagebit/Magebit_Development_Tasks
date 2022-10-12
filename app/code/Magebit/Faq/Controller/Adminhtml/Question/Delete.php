<?php
declare(strict_types = 1);

namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magebit\Faq\Model\QuestionRepository;
use Magento\Backend\App\AbstractAction;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Exception\NoSuchEntityException;

class Delete extends AbstractAction
{
    /**
     * @var QuestionRepository
     */
    protected QuestionRepository $questionRepository;

    /**
     * @param Context $context
     * @param QuestionRepository $questionRepository
     */
    public function __construct(
        Context $context,
        QuestionRepository $questionRepository
    ) {
        parent::__construct($context);
        $this->questionRepository = $questionRepository;
    }

    /**
     * @throws NoSuchEntityException
     */
    public function execute()
    {
        $questionId = (int)$this->getRequest()->getParam('id');

        $this->questionRepository->deleteById($questionId);

        return $this->resultRedirectFactory->create()->setPath("faq/question/index");
    }
}
