<?php
declare(strict_types = 1);

namespace Magebit\Faq\Model;

use Magebit\Faq\Api\QuestionManagementInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Magebit\Faq\Model\QuestionRepository;
use Magebit\Faq\Api\Data\QuestionInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class QuestionManagement implements QuestionManagementInterface
{
    /**
     * @var QuestionRepository
     */
    private QuestionRepository $questionRepository;

    /**
     * @param QuestionRepository $questionRepository
     */
    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    /**
     * @param $item
     * @return void
     * @throws AlreadyExistsException
     * @throws NoSuchEntityException
     */
    public function enableQuestion($item):void
    {
        $question = $this->questionRepository->getById($item->getId());
        $question->setStatus(QuestionInterface::ENABLED);
        $this->questionRepository->save($question);
    }

    /**
     * @param $item
     * @return void
     * @throws AlreadyExistsException
     * @throws NoSuchEntityException
     */
    public function disableQuestion($item):void
    {
        $question = $this->questionRepository->getById($item->getId());
        $question->setStatus(QuestionInterface::DISABLED);
        $this->questionRepository->save($question);
    }
}
