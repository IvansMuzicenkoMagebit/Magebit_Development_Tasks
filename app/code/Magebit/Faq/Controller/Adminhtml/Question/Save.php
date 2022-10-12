<?php
declare(strict_types = 1);

namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magebit\Faq\Model\QuestionFactory;
use Magebit\Faq\Model\QuestionRepository;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;

class Save extends Action
{
    /**
     * @var QuestionRepository
     */
    protected $questionRepository;

    /**
     * @var QuestionFactory
     */
    private $questionFactory;

    public function __construct(
        Context $context,
        QuestionRepository $questionRepository,
        QuestionFactory $questionFactory
    )
    {
        parent::__construct($context);
        $this->questionRepository = $questionRepository;
        $this->questionFactory = $questionFactory;
    }

    /**
     * @throws NoSuchEntityException
     * @throws AlreadyExistsException
     */
    public function execute()
    {
        $question = $this->questionFactory->create()
            ->setData($this->getRequest()->getPostValue());
        $this->questionRepository->save($question);

        if ($this->getRequest()->getParam("back") == "edit") {
            return $this->resultRedirectFactory->create()->setPath("*/*/edit", ['id' => $this->getRequest()->getParam('id')]);
        }
        return $this->resultRedirectFactory->create()->setPath("faq/question/index");
    }
}
