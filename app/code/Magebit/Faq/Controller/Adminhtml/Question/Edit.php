<?php
declare(strict_types = 1);

namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magebit\Faq\Controller\Adminhtml\AbstractQuestionActions;
use Magebit\Faq\Model\Question;
use Magebit\Faq\Model\QuestionFactory;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magebit\Faq\Model\QuestionRepository;

class Edit extends AbstractQuestionActions
{

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var QuestionRepository
     */
    protected QuestionRepository $questionRepository;

    /**
     * @param Context $context
     * @param Registry $coreRegistry
     * @param QuestionFactory $questionFactory
     * @param QuestionRepository $questionRepository
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        QuestionFactory $questionFactory,
        QuestionRepository $questionRepository,
        PageFactory $resultPageFactory
    )
    {
        parent::__construct($context, $coreRegistry, $questionFactory);
        $this->resultPageFactory = $resultPageFactory;
        $this->questionRepository = $questionRepository;
    }

    /**
     * @throws NoSuchEntityException
     */
    public function execute()
    {
        $questionId = $this->getRequest()->getParam('id');

        if ($questionId) {
            $model = $this->questionRepository->getById($questionId);
        } else {
            $model = $this->_questionFactory->create();
        }

        $this->_coreRegistry->register('question', $model);

        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->_initAction($resultPage);
        return $resultPage;
    }
}
