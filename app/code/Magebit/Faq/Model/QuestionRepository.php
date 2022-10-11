<?php
declare(strict_types = 1);

namespace Magebit\Faq\Model;

use Magebit\Faq\Api\Data\QuestionInterface;
use Magebit\Faq\Api\Data\QuestionSearchResultsInterface;
use Magebit\Faq\Api\Data\QuestionSearchResultsInterfaceFactory;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magebit\Faq\Model\ResourceModel\Question\CollectionFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
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
     * @var QuestionSearchResultsInterfaceFactory
     */
    private QuestionSearchResultsInterfaceFactory $searchResultFactory;

    /**
     * @param QuestionFactory $questionFactory
     * @param CollectionFactory $collectionFactory
     * @param QuestionSearchResultsInterfaceFactory $questionSearchResultsInterfaceFactory
     */
    public function __construct(
        QuestionFactory $questionFactory,
        CollectionFactory $collectionFactory,
        QuestionSearchResultsInterfaceFactory $questionSearchResultsInterfaceFactory
    ) {
        $this->questionFactory = $questionFactory;
        $this->collectionFactory = $collectionFactory;
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
     * @param SearchCriteriaInterface $searchCriteria
     * @param $collection
     * @return void
     */
    private function addFiltersToCollection(SearchCriteriaInterface $searchCriteria, $collection): void
    {
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            $fields = $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                $fields[] = $filter->getField();
                $conditions[] = [$filter->getConditionType() => $filter->getValue()];
            }
            $collection->addFieldToFilter($fields, $conditions);
        }
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param $collection
     * @return void
     */
    private function addSortOrdersToCollection(SearchCriteriaInterface $searchCriteria, $collection): void
    {
        foreach ((array) $searchCriteria->getSortOrders() as $sortOrder) {
            $direction = $sortOrder->getDirection() == SortOrder::SORT_ASC ? 'asc' : 'desc';
            $collection->addOrder($sortOrder->getField(), $direction);
        }
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param $collection
     * @return void
     */
    private function addPagingToCollection(SearchCriteriaInterface $searchCriteria, $collection): void
    {
        $collection->setPageSize($searchCriteria->getPageSize());
        $collection->setCurPage($searchCriteria->getCurrentPage());
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param $collection
     * @return QuestionSearchResultsInterface
     */
    private function buildSearchResult(SearchCriteriaInterface $searchCriteria, $collection)
    {
        $searchResults = $this->searchResultFactory->create();

        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return QuestionSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();

        $this->addFiltersToCollection($searchCriteria, $collection);
        $this->addSortOrdersToCollection($searchCriteria, $collection);
        $this->addPagingToCollection($searchCriteria, $collection);

        $collection->load();

        return $this->buildSearchResult($searchCriteria, $collection);
    }
}
