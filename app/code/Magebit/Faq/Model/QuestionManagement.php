<?php
declare(strict_types = 1);

namespace Magebit\Faq\Model;

use Magebit\Faq\Api\Data\QuestionInterface;
use Magebit\Faq\Api\QuestionManagementInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;

class QuestionManagement implements QuestionManagementInterface
{

    /**
     * @var QuestionFactory
     */
    private QuestionFactory $questionFactory;

    /**
     * @param QuestionFactory $questionFactory
     */
    public function __construct(QuestionFactory $questionFactory)
    {
        $this->questionFactory = $questionFactory;
    }

    /**
     * @param int $id
     * @return void
     * @throws AlreadyExistsException
     */
    public function enableQuestion(int $id):void
    {
        $question = $this->questionFactory->create();
        $question->getResource()->load($question, $id);
        $question->setStatus(1);
        $question->getResource()->save($question);
    }

    /**
     * @param int $id
     * @return void
     * @throws AlreadyExistsException
     */
    public function disableQuestion(int $id):void
    {
        $question = $this->questionFactory->create();
        $question->getResource()->load($question, $id);
        $question->setStatus(0);
        $question->getResource()->save($question);
    }

}
