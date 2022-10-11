<?php
declare(strict_types = 1);

namespace Magebit\Faq\Block;

use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\Template;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magento\Framework\Api\SortOrder;

class QuestionList extends Template
{
    /**
     * @var SortOrder
     */
    protected SortOrder $sortOrder;

    /**
     * @param Template\Context $context
     * @param QuestionRepositoryInterface $questionRepository
     * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        QuestionRepositoryInterface $questionRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
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
        $this->setTemplate('question-list.phtml');
    }

    /**
     * @return \Magento\Framework\Api\SearchCriteria
     */
    private function _getSearchCriteria():SearchCriteria
    {
        $sortOrder = $this->sortOrder->setField("position")->setDirection("ASC");
        return $this->_search->addFilter('status', '1')->setSortOrders([$sortOrder])->create();
    }


    /**
     * Get all pages array function
     * @return array
     * @throws LocalizedException
     */
    public function getFaqList():array
    {
        $list = [];
        foreach ($this->_faqList->getList($this->_getSearchCriteria())->getItems() as $item) {
            $list[] = $item;
        }
        return $list;
    }


}

