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

    public function getById($id)
    {
        $question = $this->questionFactory->create();
        $question->getResource()->load($question, $id);
        if (! $question->getId()) {
            throw new NoSuchEntityException(__('Unable to find question with ID "%1"', $id));
        }
        return $question;
    }

    public function save(QuestionInterface $question)
    {
        $question->getResource()->save($question);
        return $question;
    }

    public function delete(QuestionInterface $question)
    {
        $question->getResource()->delete($question);
    }

    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->questionCollectionFactory->create();

        $collection->load();

        return $this->buildSearchResult($searchCriteria, $collection);
    }


}
