<?php
declare(strict_types = 1);

namespace Magebit\Faq\Block;

use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magebit\Faq\Api\Data\QuestionInterface;

class QuestionList extends Template
{
    /**
     * @var SortOrder
     */
    protected SortOrder $sortOrder;

    /**
     * @param Context $context
     * @param QuestionRepositoryInterface $questionRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param array $data
     */
    public function __construct(
        Context $context,
        QuestionRepositoryInterface $questionRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SortOrder $sortOrder,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_faqList = $questionRepository;
        $this->_search = $searchCriteriaBuilder;
        $this->sortOrder = $sortOrder;
    }
    protected function _construct()
    {
        parent::_construct();
    }

    /**
     * @return SearchCriteria
     */
    private function _getSearchCriteria():SearchCriteria
    {
        $sortOrder = $this->sortOrder->setField(QuestionInterface::PFIELD)->setDirection("ASC");
        return $this->_search
            ->addFilter(QuestionInterface::SFIELD, QuestionInterface::ENABLED)
            ->setSortOrders([$sortOrder])
            ->create();
    }

    /**
     * Get all pages array function
     * @return array
     * @throws LocalizedException
     */
    public function getFaqList():array
    {
        return $this->_faqList->getList($this->_getSearchCriteria())->getItems();
    }
}
