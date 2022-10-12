<?php
declare(strict_types = 1);

namespace Magebit\Faq\Model;

use Magebit\Faq\Api\Data\QuestionInterface;
use Magebit\Faq\Api\Data\QuestionSearchResultsInterface;
use Magebit\Faq\Api\Data\QuestionSearchResultsInterfaceFactory;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magebit\Faq\Model\ResourceModel\Question\CollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;

class QuestionRepository implements QuestionRepositoryInterface
{
    /**
     * @var QuestionFactory
     */
    private QuestionFactory $questionFactory;

    /**
     * @var CollectionFactory
     */
    private CollectionFactory $collectionFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var QuestionSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var QuestionSearchResultsInterfaceFactory
     */
    private QuestionSearchResultsInterfaceFactory $searchResultFactory;

    /**
     * @param QuestionFactory $questionFactory
     * @param CollectionFactory $collectionFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param QuestionSearchResultsInterfaceFactory $searchResultsFactory
     * @param QuestionSearchResultsInterfaceFactory $questionSearchResultsInterfaceFactory
     */
    public function __construct(
        QuestionFactory $questionFactory,
        CollectionFactory $collectionFactory,
        CollectionProcessorInterface $collectionProcessor = null,
        QuestionSearchResultsInterfaceFactory $searchResultsFactory,
        QuestionSearchResultsInterfaceFactory $questionSearchResultsInterfaceFactory
    ) {
        $this->questionFactory = $questionFactory;
        $this->collectionFactory = $collectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->searchResultFactory = $questionSearchResultsInterfaceFactory;
    }

    /**
     * @param $id
     * @return Question
     * @throws NoSuchEntityException
     */
    public function getById($id): Question
    {
        $question = $this->questionFactory->create();
        $question->getResource()->load($question, $id);
        if (! $question->getId()) {
            throw new NoSuchEntityException(__('Unable to find question with ID "%1"', $id));
        }
        return $question;
    }

    /**
     * @param int $id
     * @return QuestionInterface
     * @throws NoSuchEntityException
     */
    public function get(int $id): QuestionInterface
    {
        $question = $this->questionFactory->create();
        $question->getResource()->load($question, $id);
        if (! $question->getId()) {
            throw new NoSuchEntityException(__('Unable to find question with ID "%1"', $id));
        }
        return $question;
    }

    /**
     * @param int $id
     * @return void
     * @throws NoSuchEntityException
     * @throws \Exception
     */
    public function deleteById(int $id): void
    {
        $this->delete($this->getById($id));
    }

    /**
     * @param QuestionInterface $question
     * @return QuestionInterface
     * @throws AlreadyExistsException
     */
    public function save(QuestionInterface $question):QuestionInterface
    {
        $question->getResource()->save($question);
        return $question;
    }

    /**
     * @param QuestionInterface $question
     * @return void
     * @throws \Exception
     */
    public function delete(QuestionInterface $question):void
    {
        $question->getResource()->delete($question);
    }


    /**
     * @param SearchCriteriaInterface $criteria
     * @return QuestionSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $criteria)
    {
        $collection = $this->collectionFactory->create();

        $this->collectionProcessor->process($criteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }
}
