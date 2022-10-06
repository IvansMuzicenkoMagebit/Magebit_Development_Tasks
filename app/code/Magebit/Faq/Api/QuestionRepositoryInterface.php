<?php
namespace Api;


use Magebit\Faq\Api\Data\QuestionInterface;
use Magento\Framework\Api\SearchCriteriaInterface;


interface QuestionRepositoryInterface
{
    /**
     * @param int $id
     * @return QuestionInterface
     */
    public function get(int $id):QuestionInterface;

    /**
     * @param QuestionInterface $question
     * @return QuestionInterface
     */
    public function save(QuestionInterface $question):QuestionInterface;

    /**
     * @param QuestionInterface $question
     * @return void
     */
    public function delete(QuestionInterface $question):void;

    /**
     * @param QuestionInterface $id
     * @return void
     */
    public function deleteById(QuestionInterface $id):void;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return QuestionSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria):QuestionSearchResultsInterface;


}
