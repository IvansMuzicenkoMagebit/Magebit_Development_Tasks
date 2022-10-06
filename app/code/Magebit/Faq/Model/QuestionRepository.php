<?php

namespace Magebit\Faq\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\NoSuchEntityException;
use Magebit\Faq\Api\Data\QuestionInterface;
use Magebit\Faq\Api\Data\QuestionSearchResultsInterface;
use Magebit\Faq\Api\Data\QuestionSearchResultsInterfaceFactory;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magebit\Faq\Model\ResourceModel\Question\Collection;
use Magebit\Faq\Model\ResourceModel\Question\CollectionFactory as QuestionCollectionFactory;

class QuestionRepository implements QuestionRepositoryInterface
{
    /**
     * @var QuestionFactory
     */
    private $questionFactory;

    /**
     * @var QuestionCollectionFactory
     */
    private $questionCollectionFactory;

    /**
     * @var QuestionSearchResultsInterfaceFactory
     */
    private $searchResultFactory;

    public function __construct(
        QuestionFactory $questionFactory,
        QuestionCollectionFactory $questionCollectionFactory,
        QuestionSearchResultInterfaceFactory $questionSearchResultInterfaceFactory)
    {
        $this->questionFactory = $questionFactory;
        $this->questionCollectionFactory = $questionCollectionFactory;
        $this->searchResultFactory = $questionSearchResultInterfaceFactory;
    }

    /**
     * @param $id
     * @return Question
     * @throws NoSuchEntityException
     */
    public function getById($id)
    {
        $question = $this->questionFactory->create();
        $question->getResource()->load($question, $id);
        if (! $question->getId()) {
            throw new NoSuchEntityException(__('Unable to find question with ID "%1"', $id));
        }
        return $question;
    }

    /**
     * @param QuestionInterface $question
     * @return QuestionInterface
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function save(QuestionInterface $question)
    {
        $question->getResource()->save($question);
        return $question;
    }

    /**
     * @param QuestionInterface $question
     * @return void
     * @throws \Exception
     */
    public function delete(QuestionInterface $question)
    {
        $question->getResource()->delete($question);
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return mixed
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->questionCollectionFactory->create();

        $this->addFiltersToCollection($searchCriteria, $collection);
        $this->addSortOrdersToCollection($searchCriteria, $collection);
        $this->addPagingToCollection($searchCriteria, $collection);

        $collection->load();

        return $this->buildSearchResult($searchCriteria, $collection);
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     * @return void
     */
    private function addFiltersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
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
     * @param Collection $collection
     * @return void
     */
    private function addSortOrdersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        foreach ((array) $searchCriteria->getSortOrders() as $sortOrder) {
            $direction = $sortOrder->getDirection() == SortOrder::SORT_ASC ? 'asc' : 'desc';
            $collection->addOrder($sortOrder->getField(), $direction);
        }
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     * @return void
     */
    private function addPagingToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        $collection->setPageSize($searchCriteria->getPageSize());
        $collection->setCurPage($searchCriteria->getCurrentPage());
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     * @return mixed
     */
    private function buildSearchResult(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        $searchResults = $this->searchResultFactory->create();

        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }


}
